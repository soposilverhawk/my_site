<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType
{
    private static ?ObjectType $instance = null;

    public static function getType(): ObjectType
    {
        if (self::$instance === null) {
            self::$instance = new ObjectType([
                'name' => 'Category',
                'fields' => [
                    'id' => Type::nonNull(Type::int()),
                    'name' => Type::nonNull(Type::string()),
                ],
            ]);
        }

        return self::$instance;
    }
}