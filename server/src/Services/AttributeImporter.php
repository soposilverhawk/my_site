<?php

namespace App\Services;

use App\Repositories\AttributeRepository;
use App\Models\Attribute\TextAttribute;
use App\Models\Attribute\SwatchAttribute;

class AttributeImporter
{
    public function __construct(private AttributeRepository $repo)
    {
    }

    /**
     * Imports attributes for a single product.
     */
    public function import(int $productId, array $attributeData): void
    {
        foreach ($attributeData as $attr) {

            // Choose attribute class
            $attrClass = $attr['type'] === 'text'
                ? TextAttribute::class
                : SwatchAttribute::class;

            // Create attribute model
            $attribute = new $attrClass(
                $attr['id'],
                $attr['name'],
                $attr['type'],
                $attr['items']
            );

            // Insert / get DB attribute entry
            $attrDbId = $this->repo->upsertProductAttribute($productId, $attribute);

            // Insert its items
            $this->repo->insertAttributeItems($attrDbId, $attribute);
        }
    }
}