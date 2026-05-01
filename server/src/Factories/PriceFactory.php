<?php

namespace App\Factories;

use App\Models\Price\Price;
use App\Models\Price\DefaultPrice;

class PriceFactory
{
    /**
     * Create a Price instance based on type.
     *
     * @param float $amount Price amount
     * @param string $currency_label Price currency label 
     * @param string $currency_symbol Price currency symbol
     * @return Price
     * @throws \Exception
     */
    public static function create(array $data): Price
    {
        return new DefaultPrice(
            $data['amount'],
            $data['currency_label'],
            $data['currency_symbol']
        );
    }
}