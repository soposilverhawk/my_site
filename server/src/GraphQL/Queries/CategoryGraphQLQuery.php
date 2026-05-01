<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\CategoryType;
use App\GraphQL\Resolvers\CategoryResolver;

class CategoryGraphQLQuery
{
    public static function getFields(CategoryResolver $resolver): array
    {
        return [
            'categories' => [
                'type' => Type::listOf(CategoryType::getType()),
                'resolve' => [$resolver, 'categories']
            ],
            'category' => [
                'type' => CategoryType::getType(),
                'args' => [
                    'id' => Type::nonNull(Type::int())
                ],
                'resolve' => [$resolver, 'category']
            ]
        ];
    }
}