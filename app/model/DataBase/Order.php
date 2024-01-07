<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Order extends DataBase
{
    public function getByUserId($user)
    {
        $sql = "SELECT order_id FROM $this->dbName.orders WHERE user_id = :user_id";
        $params = [
            'user_id' => $user
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function update($user, $address, $id)
    {
        $sql = "UPDATE $this->dbName.orders
            SET 
                user_id = :user_id,
                address_id = :address_id
            WHERE
                order_id = :order_id
            ";
        $params = [
            'user_id' => $user,
            'address_id' => $address,
            'oder_id' => $id
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function insert($user, $address)
    {
        $sql = "INSERT INTO $this->dbName.orders (
                user_id,
                address_id
            ) 
            VALUES (
                :user_id,
                :address_id
            )";
        $params = [
            'user_id' => $user,
            'address_id' => $address
        ];
        try {
            // Transaction for multiples request
            $this->getConnection()->beginTransaction();
            $this->getConnection()->prepare($sql)->execute($params);
            $orderId = $this->getConnection()->lastInsertId();
            $this->getConnection()->commit();

            return $orderId;
        } catch (\PDOException $e) {
            // Cancel if error in transaction
            $this->getConnection()->rollBack();
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
