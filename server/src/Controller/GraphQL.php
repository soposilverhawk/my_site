<?php

namespace App\Controller;

use App\GraphQL\ResolverFactory\ResolverFactory;
use GraphQL\GraphQL as GraphQLBase;
use App\GraphQL\Schema\GraphQLSchema;
use RuntimeException;
use Throwable;

class GraphQL
{
    static public function handle()
    {
        try {
            $categoryResolver = ResolverFactory::makeCategoryResolver();
            $productResolver = ResolverFactory::makeProductResolver();
            $orderResolver = ResolverFactory::makeOrderResolver();
            $schema = GraphQLSchema::build($categoryResolver, $productResolver, $orderResolver);

            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQLBase::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (Throwable $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage(),
                ]
            ];
        }

        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($output);
    }
}