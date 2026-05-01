<?php

namespace App\Models\Category;

class ClothesCategory extends Category
{
    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }

    public function getRequiredAttributes(): array
    {
        return ['Size'];
    }

    public function validateAttributes(array $productAttributes): void
    {
        if (empty($productAttributes['Size'])) {
            throw new \Exception('Clothes must have a Size attribute');
        }
    }
}