<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Review extends DataBase
{
    public function getAllReviews()
    {
        $sql = "SELECT * FROM $this->dbName.reviews";
        try {
            $stmt = $this->getConnection()->query($sql);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function insert($user, $product, $rating, $text)
    {
        $sql = "INSERT INTO $this->dbName.reviews (
            user_id,
            product_id,
            rating,
            text
        ) 
        VALUES (
            :user_id,
            :product_id,
            :rating,
            :text
        )";
        $params = [
            'user_id' => $user,
            'product_id' => $product,
            'rating' => $rating,
            'text' => $text
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
