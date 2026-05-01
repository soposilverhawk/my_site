<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class CategoryImporter
{
    private CategoryRepository $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function import(array $categories): array
    {
        $map = [];

        foreach ($categories as $category) {
            $name = $category['name'];

            // Check if category exists
            $id = $this->categories->findIdByName($name);

            // Insert if missing
            if (!$id) {
                $id = $this->categories->insert($name);
            }

            $map[$name] = $id;
        }

        return $map;
    }
}