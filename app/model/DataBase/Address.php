<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Address extends DataBase
{
    public function getAddressByUserId($id)
    {
        $sql = "SELECT * 
            FROM $this->dbName.addresses as a
            INNER JOIN $this->dbName.useraddresses AS ua
            ON a.address_id = ua.address_id
            WHERE a.status = 'active' AND ua.user_id = :user_id";
        $params = [
            'user_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function insertUserAddress($user_id, $address_id)
    {
        $sql = "INSERT INTO $this->dbName.useraddresses (
            user_id,
            address_id
        )
        VALUES (
            :user_id,
            :address_id
        )";
        $params = [
            'user_id' => $user_id,
            'address_id' => $address_id
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function insertAddress($datas)
    {
        $sql = "INSERT INTO $this->dbName.addresses (
                street,
                city,
                zip_code,
                region,
                country
            )
            VALUES (
                :street,
                :city,
                :zip_code,
                :region,
                :country
            )";
        $params = [
            'street' => $datas['street'],
            'city' => $datas['city'],
            'zip_code' => $datas['zip_code'],
            'region' => $datas['region'],
            'country' => $datas['country']
        ];
        try {
            // Transaction for multiples request
            $this->getConnection()->beginTransaction();
            $this->getConnection()->prepare($sql)->execute($params);
            $addressId = $this->getConnection()->lastInsertId();
            $this->getConnection()->commit();

            return $addressId;
        } catch (\PDOException $e) {
            // Cancel if error in transaction
            $this->getConnection()->rollBack();
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
