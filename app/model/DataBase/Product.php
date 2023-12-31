<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Product extends DataBase
{
    public function getProductsByCategory($category)
    {
        $sql = "SELECT *
        FROM $this->dbName.products AS p
        INNER JOIN $this->dbName.productcategories AS pc
        ON p.product_id = pc.product_id
        INNER JOIN $this->dbName.categories AS c
        ON pc.category_id = c.category_id
        WHERE p.status = 'active' AND pc.status = 'active' AND c.name = :category";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'category' => $category
        ];
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
