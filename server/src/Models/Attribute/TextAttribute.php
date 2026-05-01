<?php

namespace App\Models\Attribute;

class TextAttribute extends Attribute
{
    public function getType(): string
    {
        return 'text';
    }
}