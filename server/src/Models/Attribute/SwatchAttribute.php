<?php

namespace App\Models\Attribute;

class SwatchAttribute extends Attribute
{
    public function getType(): string
    {
        return 'swatch';
    }
}