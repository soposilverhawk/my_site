<?php

namespace App\Models\Order;

class DefaultOrder extends Order
{
    protected function calculateTotal(): float
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item['price'] * $item['qty'];
        }
        $this->total = $sum;
        return $sum;
    }
}