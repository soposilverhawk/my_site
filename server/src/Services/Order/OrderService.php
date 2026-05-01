<?php

namespace App\Services\Order;

use App\Models\Order\Order;
use App\Repositories\OrderRepository;
use App\Services\Product\ProductService;
use Exception;

class OrderService
{
    private OrderRepository $repo;
    private ProductService $productService;

    public function __construct(OrderRepository $repo, ProductService $productService)
    {
        $this->repo = $repo;
        $this->productService = $productService;
    }

    /**
     * Place a new order
     *
     * @param Order $order
     * @param string $currencyLabel
     * @param string $currencySymbol
     * @return Order
     * @throws Exception
     */
    public function placeOrder(Order $order, string $currencyLabel = 'USD', string $currencySymbol = '$'): Order
    {
        if (empty($order->getItems())) {
            throw new Exception("Cannot place an order with no items.");
        }

        $total = 0;
        $mergedItems = [];

        foreach ($order->getItems() as $item) {
            if (!isset($item['id'], $item['qty'])) {
                throw new Exception("Invalid item data: " . json_encode($item));
            }

            $selectedOptions = $item['selected_options'] ?? [];

            // Fetch price from backend
            $product = $this->productService->getProduct($item['id']);

            if (!$product->isInStock()) {
                throw new Exception("Product '{$product->getName()}' is out of stock.");
            }

            $price = $product->getPrices()[0]->getAmount(); // default price
            $currencyLabelItem = $product->getPrices()[0]->getCurrencyLabel();
            $currencySymbolItem = $product->getPrices()[0]->getCurrencySymbol();

            // Create a unique key for product + selected options
            $itemKey = $item['id'] . '_' . md5(json_encode($selectedOptions));

            if (isset($mergedItems[$itemKey])) {
                // Same product and options exist, increment quantity
                $mergedItems[$itemKey]['qty'] += $item['qty'];
            } else {
                // New item
                $mergedItems[$itemKey] = [
                    'id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $price,
                    'currency_label' => $currencyLabelItem,
                    'currency_symbol' => $currencySymbolItem,
                    'selected_options' => $selectedOptions
                ];
            }

            $total += $price * $item['qty'];
        }

        // Replace items and total in Order object
        $reflection = new \ReflectionClass($order);
        $itemsProperty = $reflection->getProperty('items');
        $itemsProperty->setAccessible(true);
        $itemsProperty->setValue($order, array_values($mergedItems)); // remove keys

        $totalProperty = $reflection->getProperty('total');
        $totalProperty->setAccessible(true);
        $totalProperty->setValue($order, $total);

        // Insert order
        $orderId = $this->repo->insert($order, $currencyLabel, $currencySymbol);
        $order->setId($orderId);

        return $order;
    }
}