<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\OrderType;
use App\GraphQL\Resolvers\OrderResolver;
use GraphQL\Type\Definition\InputObjectType;

class OrderGraphQLMutation
{
    public static function getFields(OrderResolver $resolver): array
    {
        return [
            'placeOrder' => [
                'type' => OrderType::getType(),
                'args' => [
                    'items' => Type::nonNull(
                        Type::listOf(
                            Type::nonNull(
                                new \GraphQL\Type\Definition\InputObjectType([
                                    'name' => 'OrderItemInput',
                                    'fields' => [
                                        'id' => Type::nonNull(Type::int()),
                                        'qty' => Type::nonNull(Type::int()),
                                        'selected_options' => Type::listOf(
                                            new InputObjectType([
                                                'name' => 'SelectedOptionInput',
                                                'fields' => [
                                                    'name' => Type::nonNull(Type::string()),
                                                    'value' => Type::nonNull(Type::string())
                                                ]
                                            ])
                                        )
                                    ]
                                ])
                            )
                        )
                    )
                ],
                'resolve' => [$resolver, 'placeOrder']
            ]
        ];
    }
}