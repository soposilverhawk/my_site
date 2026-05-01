<?php

namespace App\Transformers;

use App\Models\Category\Category;

class CategoryTransformer
{
    public static function toArray(Category $category): array
    {
        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
        ];
    }
}