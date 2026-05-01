<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Order\Order;
use PDO;
use Exception;

class OrderRepository
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->connect();
    }

    /**
     * Insert a new order with its items using backend prices
     *
     * @param Order $order
     * @param string $currencyLabel
     * @param string $currencySymbol
     * @return int Inserted order ID
     * @throws Exception
     */
    public function insert(Order $order, string $currencyLabel = 'USD', string $currencySymbol = '$'): int
    {
        try {
            $this->pdo->beginTransaction();

            $items = $order->getItems();
            $total = 0;
            $orderItems = [];

            // 1️⃣ Prepare order items and calculate total
            foreach ($items as $item) {
                if (!isset($item['id'], $item['qty'])) {
                    throw new Exception("Invalid item data: " . json_encode($item));
                }

                // Fetch price from backend (product_prices table)
                $stmtPrice = $this->pdo->prepare("
                    SELECT amount, currency_label, currency_symbol
                    FROM product_prices
                    WHERE product_id = :pid
                    ORDER BY id ASC
                    LIMIT 1
                ");
                $stmtPrice->execute(['pid' => $item['id']]);
                $priceRow = $stmtPrice->fetch(PDO::FETCH_ASSOC);

                if (!$priceRow) {
                    throw new Exception("Product ID {$item['id']} has no price set in the database.");
                }

                $price = (float)$priceRow['amount'];
                $qty = (int)$item['qty'];
                $total += $price * $qty;

                $orderItems[] = [
                    'product_id' => $item['id'],
                    'qty' => $qty,
                    'price' => $price,
                    'currency_label' => $priceRow['currency_label'],
                    'currency_symbol' => $priceRow['currency_symbol'],
                    'selected_options' => $item['selected_options'] ?? [] // keep as array here
                ];
            }

            // 2️⃣ Insert into orders table
            $stmt = $this->pdo->prepare("
                INSERT INTO orders (order_uid, total, currency_label, currency_symbol)
                VALUES (:uid, :total, :label, :symbol)
            ");
            $orderUid = uniqid('order_', true);
            $stmt->execute([
                'uid' => $orderUid,
                'total' => $total,
                'label' => $currencyLabel,
                'symbol' => $currencySymbol
            ]);

            $orderId = (int)$this->pdo->lastInsertId();
            $order->setId($orderId);

            // 3️⃣ Insert items into order_items table
            $stmtItem = $this->pdo->prepare("
                INSERT INTO order_items 
                (order_id, product_id, quantity, price, currency_label, currency_symbol, selected_options)
                VALUES (:order_id, :product_id, :qty, :price, :label, :symbol, :selected_options)
            ");

            foreach ($orderItems as $oi) {
                $stmtItem->execute([
                    'order_id' => $orderId,
                    'product_id' => $oi['product_id'],
                    'qty' => $oi['qty'],
                    'price' => $oi['price'],
                    'label' => $oi['currency_label'],
                    'symbol' => $oi['currency_symbol'],
                    'selected_options' => json_encode($oi['selected_options']) // encode once here
                ]);
            }

            $this->pdo->commit();
            return $orderId;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}