<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Category extends DataBase
{
    public function insertProductCategory($product_id, $category_id)
    {
        $sql = "INSERT INTO 
            $this->dbName.productcategories(
                category_id,
                product_id
            )
            VALUES (
                :category_id,
                :product_id
            )";
        $params = [
            'category_id' => $category_id,
            'product_id' => $product_id
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
