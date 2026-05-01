<?php

namespace App\Models\Category;

class TechCategory extends Category
{
    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }

    public function getRequiredAttributes(): array
    {
        return [];
    }

    public function validateAttributes(array $productAttributes): void
    {
        return;
    }
}