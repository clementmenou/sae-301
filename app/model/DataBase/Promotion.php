<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Promotion extends DataBase
{
    public function insertPromotion($product_id, $discount_percent, $start_date, $end_date)
    {
        $sql = "INSERT INTO 
            $this->dbName.promotions(
                product_id,
                discount_percent,
                start_date,
                end_date
            )
            VALUES (
                :product_id,
                :discount_percent,
                :start_date,
                :end_date
            )";
        $params = [
            'product_id' => $product_id,
            'discount_percent' => $discount_percent,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
