<?php

namespace App\Models\Product;

use App\Models\Category\Category;

class TechProduct extends Product
{
    public function __construct(
        ?int $id,
        string $productUID,
        string $name,
        bool $inStock,
        Category $categoryObject,
        string $brand,
        string $description,
        array $gallery = [],
        array $attributes = [],
        array $prices = []
    ) {
        parent::__construct(
            $id,
            $productUID,
            $name,
            $inStock,
            $categoryObject,
            $brand,
            $description,
            $gallery,
            $attributes,
            $prices
        );
    }

    public function getType(): string
    {
        return $this->categoryObject->getName();
    }
}