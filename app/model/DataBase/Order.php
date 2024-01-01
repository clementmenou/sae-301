<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Order extends DataBase
{
    public function insert($datas)
    {
        $sql = "INSERT INTO $this->dbName.orders (
                user_id
            ) 
            VALUES (
                :user_id
            )";
        $params = [
            'user_id' => $datas['userId']
        ];
        try {
            // Transaction for multiples request
            $this->getConnection()->beginTransaction();
            $this->getConnection()->prepare($sql)->execute($params);
            $userId = $this->getConnection()->lastInsertId();
            $this->getConnection()->commit();

            return $userId;
        } catch (\PDOException $e) {
            // Cancel if error in transaction
            $this->getConnection()->rollBack();
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
