<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\AttributeItemType;

class AttributeType
{
    private static ?ObjectType $instance = null;

    public static function getType(): ObjectType
    {
        if (self::$instance === null) {
            self::$instance = new ObjectType([
                'name' => 'Attribute',
                'fields' => [
                    'attribute_id' => [
                        'type' => Type::string(),
                        'resolve' => fn($attribute) => $attribute->getId()
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => fn($attribute) => $attribute->getName()
                    ],
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => fn($attribute) => $attribute->getType()
                    ],
                    'product_attribute_items' => [
                        'type' => Type::listOf(AttributeItemType::getType()),
                        'resolve' => fn($attribute) => $attribute->getItems()
                    ]
                ],
            ]);
        }

        return self::$instance;
    }
}
