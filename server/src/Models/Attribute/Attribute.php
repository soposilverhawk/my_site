<?php

namespace App\Models\Attribute;

abstract class Attribute
{
    protected string $id;
    protected string $name;  
    protected string $type;
    protected array $items = [];   

    public function __construct(
        string $id,
        string $name,
        string $type,
        array $items = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;

        // Convert item arrays into objects
        $this->setItems($items);
    }

    abstract public function getType(): string;

    // Getters
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getItems(): array
    {
        return $this->items;
    }
    
    public function getItem(string $id): ?AttributeItem
    {
        return $this->items[$id] ?? null;
    }

    // Setters
    public function setItems(array $items): void
    {
        $this->items = [];

        foreach ($items as $item) {
            if ($item instanceof AttributeItem) {
                // store object
                $this->items[$item->getId()] = $item;
            } else {
                $this->items[$item['id']] = new AttributeItem(
                    $item['id'],
                    $item['displayValue'],
                    $item['value']
                );
            }
        }
    }
}