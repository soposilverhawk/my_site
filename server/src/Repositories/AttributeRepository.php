<?php

namespace App\Repositories;

use PDO;
use App\Models\Attribute\Attribute;

class AttributeRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function upsertProductAttribute(int $productId, Attribute $attr): int
    {
        $stmt = $this->pdo->prepare("
            SELECT id FROM product_attributes 
            WHERE product_id = :pid AND attribute_id = :attr_id
        ");

        $stmt->execute([
            'pid'     => $productId,
            'attr_id' => $attr->getId()
        ]);

        $attrDbId = $stmt->fetchColumn();

        if (!$attrDbId) {
            // Insert a new product attribute
            $stmt = $this->pdo->prepare("
                INSERT INTO product_attributes (attribute_id, product_id, name, type)
                VALUES (:attr_id, :pid, :name, :type)
            ");

            $stmt->execute([
                'attr_id' => $attr->getId(),
                'pid'     => $productId,
                'name'    => $attr->getName(),
                'type'    => $attr->getType()
            ]);

            return (int)$this->pdo->lastInsertId();
        }

        return (int)$attrDbId;
    }

    /**
     * Insert items for attribute (IGNORE duplicates)
     */
    public function insertAttributeItems(int $attributeDbId, Attribute $attr): void
    {
        foreach ($attr->getItems() as $item) {
            $stmt = $this->pdo->prepare("
                INSERT IGNORE INTO product_attribute_items (
                    attribute_item_id, display_value, attribute_item_value, attribute_id
                ) VALUES (:item_id, :display, :value, :attr_id)
            ");

            $stmt->execute([
                'item_id' => $item->getId(),
                'display' => $item->getDisplayValue(),
                'value'   => $item->getValue(),
                'attr_id' => $attributeDbId
            ]);
        }
    }
}
