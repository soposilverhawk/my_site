<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class OrderType
{
    public static function getType(): ObjectType
    {
        return new ObjectType([
            'name' => 'Order',
            'fields' => [
                'id' => Type::int(),
                'total' => Type::float(),
                'items' => Type::listOf(
                    new ObjectType([
                        'name' => 'OrderItem',
                        'fields' => [
                            'product_id' => Type::int(),
                            'qty' => Type::int(),
                            'price' => Type::float(),
                            'selected_options' => Type::listOf(
                                new ObjectType([
                                    'name' => 'selected_option',
                                    'fields' => [
                                        'name' => Type::string(),
                                        'value' => Type::string()
                                    ]
                                ])
                            )
                        ]
                    ])
                ),
            ]
        ]);
    }
}