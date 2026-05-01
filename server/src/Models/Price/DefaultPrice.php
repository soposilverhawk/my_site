<?php

namespace App\Models\Price;

use App\Models\Price\Price;

class DefaultPrice extends Price
{
    public function getType(): string
    {
        return 'default';
    }
}