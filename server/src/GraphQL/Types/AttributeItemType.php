<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeItemType
{
    private static ?ObjectType $instance = null;

    public static function getType(): ObjectType
    {
        if (self::$instance === null) {
            self::$instance = new ObjectType([
                'name' => 'AttributeItem',
                'fields' => [
                    'display_value' => [
                        'type' => Type::string(),
                        'resolve' => fn($attributeItem) => $attributeItem->getDisplayValue(),
                    ],
                    'attribute_item_value' => [
                        'type' => Type::string(),
                        'resolve' => fn($attributeItem) => $attributeItem->getValue()
                    ],
                    'attribute_item_id' => [
                        'type' => Type::string(),
                        'resolve' => fn($attributeItem) => $attributeItem->getId()
                    ]
                ],
            ]);
        }

        return self::$instance;
    }
}