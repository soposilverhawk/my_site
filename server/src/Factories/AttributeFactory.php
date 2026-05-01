<?php

namespace App\Factories;

use App\Models\Attribute\Attribute;
use App\Models\Attribute\TextAttribute;
use App\Models\Attribute\SwatchAttribute;

class AttributeFactory
{
     /**
     * Create an Attribute instance based on type.
     *
     * @param string $type "text" or "swatch"
     * @param array $data Attribute data: id, name, items
     * @return Attribute
     * @throws \Exception
     */
    public static function create(string $type, array $data): Attribute
    {
        return match($type) {
            'text' => new TextAttribute(
                $data['id'],
                $data['name'],
                'text',
                $data['items'] ?? []
            ),

            'swatch' => new SwatchAttribute(
                $data['id'],
                $data['name'],
                'swatch',
                $data['items'] ?? []
            ),

            default => throw new \Exception('Unknown attribute type: "$type"')
        };
    }
}