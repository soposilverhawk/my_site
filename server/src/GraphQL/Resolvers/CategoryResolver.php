<?php

namespace App\GraphQL\Resolvers;

use App\Services\Category\CategoryService;
use App\Transformers\CategoryTransformer;

class CategoryResolver
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function categories(): array
    {
        return array_map(
            fn($category) => CategoryTransformer::toArray($category),
            $this->service->getAllCategories()
        );
    }

    public function category($root, array $args): ?array
    {
        $category = $this->service->getCategory($args['id']);
        if (!$category) return null;
        return $category ? CategoryTransformer::toArray($category) : null;
    }
}