<?php

namespace App\Factories;

use App\Models\Product\Product;
use App\Models\Product\ClothesProduct;
use App\Models\Product\TechProduct;
use App\Models\Product\AllProduct;
use App\Factories\CategoryFactory;
use Exception;

class ProductFactory
{
    /**
     * Create a product instance based on category name.
     *
     * @param int $categoryId
     * @param string $categoryName
     * @param array  $data Fully fetched product data from DB
     * @return Product
     * @throws Exception
     */
    public static function create(int $categoryId, string $categoryName, array $data): Product
    {
        $categoryObject = CategoryFactory::create(
            $categoryId,
            $categoryName
        );

        return match (strtolower($categoryName)) {

            'clothes' => new ClothesProduct(
                $data['id'] ?? null,
                $data['productUID'],
                $data['name'],
                (bool)$data['inStock'],
                $categoryObject,
                $data['brand'],
                $data['description'],
                $data['gallery'] ?? [],
                $data['attributes'] ?? [],
                $data['prices'] ?? []
            ),

            'tech' => new TechProduct(
                $data['id'] ?? null,
                $data['productUID'],
                $data['name'],
                (bool)$data['inStock'],
                $categoryObject,
                $data['brand'],
                $data['description'],
                $data['gallery'] ?? [],
                $data['attributes'] ?? [],
                $data['prices'] ?? []
            ),

            'all' => new AllProduct(
                $data['id'] ?? null,
                $data['productUID'],
                $data['name'],
                (bool)$data['inStock'],
                $categoryObject,
                $data['brand'],
                $data['description'],
                $data['gallery'] ?? [],
                $data['attributes'] ?? [],
                $data['prices'] ?? []
            ),

            default => throw new Exception("Unknown category: $categoryName")
        };
    }
}