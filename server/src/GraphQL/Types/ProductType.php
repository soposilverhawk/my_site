<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\PriceType;
use App\GraphQL\Types\AttributeType;

class ProductType
{
    private static ?ObjectType $instance = null;

    public static function getType(): ObjectType
    {
        if (self::$instance === null) {
            self::$instance = new ObjectType([
                'name' => 'Product',
                'fields' => function () {
                    return [
                        'id' => Type::nonNull(Type::int()),
                        'product_uid' => Type::nonNull(Type::string()),
                        'name' => Type::string(),
                        'in_stock' => Type::boolean(),
                        'category_name' => Type::string(),
                        'category_id' => Type::int(),
                        'brand' => Type::string(),
                        'description' => Type::string(),
                        'product_gallery' => [
                            'type' => Type::listOf(Type::string()),
                            'resolve' => function($product) {
                                return $product['product_gallery'];
                            }
                        ],
                        'product_prices' => [
                            'type' => Type::listOf(PriceType::getType()),
                            'resolve' => function($product) {
                                return $product['product_prices'];
                            }
                        ],
                        'product_attributes' => [
                            'type' => Type::listOf(AttributeType::getType()),
                            'resolve' => function($product) {
                                return $product['product_attributes'];
                            }
                        ]
                    ];
                }
            ]);
        }

        return self::$instance;
    }
}