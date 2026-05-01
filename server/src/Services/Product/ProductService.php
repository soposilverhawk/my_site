<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use App\Repositories\ProductRepository;

class ProductService 
{
    private ProductRepository $repo;

    public function __construct(ProductRepository $repo) {
        $this->repo = $repo;
    }

    public function getAllProducts(): array {
        return $this->repo->findAll();
    }

    public function getProduct(int $id): ?Product {
        return $this->repo->findById($id);
    }

    public function getProductsByCategory(string $category): array
    {
        return $this->repo->findByCategory($category);
    }
}