<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\ProductType;
use App\GraphQL\Resolvers\ProductResolver;

class ProductGraphQLQuery
{
    public static function getFields(ProductResolver $resolver): array
    {
        return [
            'products' => [
                'type' => Type::listOf(ProductType::getType()),
                'args' => [
                    'category' => Type::string()
                ],
                'resolve' => [$resolver, 'products']
            ],
            'product' => [
                'type' => ProductType::getType(),
                'args' => [
                    'id' => Type::nonNull(Type::int())
                ],
                'resolve' => [$resolver, 'product']
            ]
        ];
    }
}