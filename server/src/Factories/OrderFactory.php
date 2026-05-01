<?php

namespace App\Factories;

use App\Models\Order\Order;
use App\Models\Order\DefaultOrder;

class OrderFactory
{
    /**
     * Create a new order instance.
     *
     * @param array $orderData Array containing at least ['items' => [...]]
     * @param string $type
     * @return Order
     */
    public static function create(array $orderData, string $type = 'default'): Order
    {
        // Ensure 'items' key exists
        $items = $orderData['items'] ?? [];

        return match ($type) {
            'default' => new DefaultOrder($items),
            default => throw new \InvalidArgumentException("Unknown order type: $type")
        };
    }
}