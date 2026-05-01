<?php

namespace App\Models\Attribute;

class AttributeItem
{
    protected string $id;
    protected string $displayValue;
    protected string $value;  

    public function __construct(string $id, string $displayValue, string $value)
    {
        $this->id = $id;
        $this->displayValue = $displayValue;
        $this->value = $value;
    }

    // Getters
    public function getId(): string
    {
        return $this->id;
    }
    
    public function getDisplayValue(): string
    {
        return $this->displayValue;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}