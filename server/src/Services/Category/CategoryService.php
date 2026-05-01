<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Models\Category\Category;

class CategoryService 
{
    private CategoryRepository $repo;

    public function __construct(CategoryRepository $repo) {
        $this->repo = $repo;
    }

    public function getAllCategories(): array {
        return $this->repo->findAll();
    }

    public function getCategory(int $id): ?Category {
        return $this->repo->findById($id);
    }
}