<?php

namespace App\GraphQL\Resolvers;

use App\Services\Order\OrderService;
use App\Services\Product\ProductService;
use App\Factories\OrderFactory;
use GraphQL\Error\UserError;

class OrderResolver
{
    private OrderService $orderService;
    private ProductService $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    /**
     * Place an order
     *
     * @param $root
     * @param array $args
     * @return array
     */
    public function placeOrder($root, array $args): array
    {
        try {
            // 1️⃣ Prepare items: fetch price from backend and include selected options
            $items = [];
            foreach ($args['items'] as $item) {
                if (!isset($item['id'], $item['qty'])) {
                    throw new UserError("Invalid item data: " . json_encode($item));
                }

                $product = $this->productService->getProduct($item['id']);
                if (!$product->isInStock()) {
                    throw new UserError("Product '{$product->getName()}' is out of stock.");
                }

                $priceObj = $product->getPrices()[0]; // default price

                $items[] = [
                    'id' => $item['id'],
                    'qty' => $item['qty'],
                    'price' => $priceObj->getAmount(),
                    'currency_label' => $priceObj->getCurrencyLabel(),
                    'currency_symbol' => $priceObj->getCurrencySymbol(),
                    'selected_options' => $item['selected_options'] ?? []
                ];
            }

            // 2️⃣ Create order
            $order = OrderFactory::create(['items' => $items]);

            // 3️⃣ Place order via service
            $placedOrder = $this->orderService->placeOrder($order);

            // 4️⃣ Map items for GraphQL response
            $responseItems = array_map(fn($item) => [
                'product_id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'currency_label' => $item['currency_label'],
                'currency_symbol' => $item['currency_symbol'],
                'selected_options' => $item['selected_options'] ?? []
            ], $placedOrder->getItems());

            return [
                'id' => $placedOrder->getId(),
                'total' => $placedOrder->getTotal(),
                'items' => $responseItems
            ];

        } catch (\Exception $e) {
            throw new UserError($e->getMessage());
        }
    }
}