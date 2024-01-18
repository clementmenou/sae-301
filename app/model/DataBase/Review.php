<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Review extends DataBase
{

    public function getReviewsByProductId($id)
    {
        $sql = "SELECT * FROM $this->dbName.reviews WHERE status = 'active' AND product_id = :id";
        $params = [
            'id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT user_id FROM $this->dbName.reviews WHERE review_id = :review_id";
        $params = [
            'review_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE $this->dbName.reviews SET status = 'inactive' WHERE review_id = :review_id";
        $params = [
            'review_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function update($text, $rating, $id)
    {
        $sql = "UPDATE $this->dbName.reviews SET text = :text, rating = :rating WHERE review_id = :review_id";
        $params = [
            'text' => $text,
            'rating' => $rating,
            'review_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
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
