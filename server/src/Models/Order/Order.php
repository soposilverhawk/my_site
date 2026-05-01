<?php

namespace App\Models\Order;

abstract class Order
{
    protected ?int $id = null;

    /**
     * Each item structure:
     * [
     *   'id' => int,
     *   'qty' => int,
     *   'price' => float,
     *   'currency_label' => string,
     *   'currency_symbol' => string,
     * ]
     */
    protected array $items = [];

    protected float $total = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
        $this->total = 0; // Backend service will handle calculation
    }

    abstract protected function calculateTotal(): float;

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}