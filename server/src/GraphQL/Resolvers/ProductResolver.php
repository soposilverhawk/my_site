<?php

namespace App\GraphQL\Resolvers;

use App\Services\Product\ProductService;
use App\Transformers\ProductTransformer;

class ProductResolver
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function products($root, array $args): array
    {
        $category = $args['category'] ?? 'all';

        $products = $category === 'all'
            ? $this->service->getAllProducts()
            : $this->service->getProductsByCategory($category);

        return array_map(
            fn($product) => ProductTransformer::toArray($product),
            $products
        );
    }

    public function product($root, array $args): ?array
    {
        $product = $this->service->getProduct($args['id']);
        if (!$product) return null;
        return $product ? ProductTransformer::toArray($product) : null;
    }
}