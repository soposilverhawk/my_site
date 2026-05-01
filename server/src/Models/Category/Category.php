<?php

namespace App\Models\Category;

abstract class Category
{
    protected int $id;
    protected string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function matches(string $categoryName): bool
    {
        return $this->getName() === $categoryName;
    }

    public function getDefaultAttributes(): array
    {
        return [];
    }

    abstract public function getRequiredAttributes(): array;

    abstract public function validateAttributes(array $productAttributes): void;
}