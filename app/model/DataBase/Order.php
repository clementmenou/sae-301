<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Order extends DataBase
{
    public function insert($id, $address)
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
            'user_id' => $id,
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
