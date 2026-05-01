<?php

namespace App\Models\Price;

abstract class Price
{
    protected float $amount;
    protected string $currency_label;
    protected string $currency_symbol;

    public function __construct(
        float $amount,
        string $currency_label,
        string $currency_symbol
    )
    {
        $this->amount = $amount;
        $this->currency_label = $currency_label;
        $this->currency_symbol = $currency_symbol;
    }

    abstract public function getType(): string;

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrencyLabel(): string
    {
        return $this->currency_label;
    }

    public function getCurrencySymbol(): string
    {
        return $this->currency_symbol;
    }
}