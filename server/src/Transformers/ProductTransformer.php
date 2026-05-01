<?php

namespace App\Transformers;

use App\Models\Product\Product;

class ProductTransformer
{
    public static function toArray(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'product_uid' => $product->getProductUID(),
            'name' => $product->getName(),
            'in_stock' => $product->isInStock(),
            'category_name' => $product->getProductCategoryName(),
            'type' => $product->getType(),
            'brand' => $product->getBrand(),
            'description' => $product->getDescription(),
            'product_gallery' => $product->getGallery(),
            'product_attributes' => $product->getAttributes(),
            'product_prices' => $product->getPrices()
        ];
    }
}