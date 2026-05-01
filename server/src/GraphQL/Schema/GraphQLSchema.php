<?php

namespace App\GraphQL\Schema;

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use App\GraphQL\Resolvers\CategoryResolver;
use App\GraphQL\Resolvers\ProductResolver;
use App\GraphQL\Queries\CategoryGraphQLQuery;
use App\GraphQL\Queries\ProductGraphQLQuery;
use App\GraphQL\Mutations\OrderGraphQLMutation;
use App\GraphQL\Resolvers\OrderResolver;

class GraphQLSchema
{
    public static function build(
        CategoryResolver $categoryResolver,
        ProductResolver $productResolver,
        OrderResolver $orderResolver
    ): Schema {
        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => array_merge(
                CategoryGraphQLQuery::getFields($categoryResolver),
                ProductGraphQLQuery::getFields($productResolver)
            )
        ]);

        $mutationType = new ObjectType([
            'name' => 'Mutation',
            'fields' => array_merge(
                OrderGraphQLMutation::getFields($orderResolver)
            )
        ]);

        return new Schema([
            'query' => $queryType,
            'mutation' => $mutationType
        ]);
    }
}