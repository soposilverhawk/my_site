<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class PriceType
{
    private static ?ObjectType $instance = null;

    public static function getType(): ObjectType
    {
        if (self::$instance === null) {
            self::$instance = new ObjectType([
                'name' => 'Price',
                'fields' => [
                    'amount' => [
                        'type' => Type::nonNull(Type::float()),
                        'resolve' => fn($price) => $price->getAmount()
                    ],
                    'currency_label' => [
                        'type' => Type::string(),
                        'resolve' => fn($price) => $price->getCurrencyLabel()
                    ],
                    'currency_symbol' => [
                        'type' => Type::string(),
                        'resolve' => fn($price) => $price->getCurrencySymbol()
                    ]
                ],
            ]);
        }

        return self::$instance;
    }
}