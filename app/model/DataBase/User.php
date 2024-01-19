<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class User extends DataBase
{
    public function updateData($dataName, $dataValue, $user_id)
    {
        $sql = "UPDATE $this->dbName.users
            SET 
                $dataName = :$dataName
            WHERE
                user_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            $dataName => $dataValue,
            'id' => $user_id
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getStatusById($id)
    {
        $sql = "SELECT status FROM $this->dbName.users WHERE user_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getUsernameById($id)
    {
        $sql = "SELECT username FROM $this->dbName.users WHERE user_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getEmailById($id)
    {
        $sql = "SELECT email FROM $this->dbName.users WHERE user_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM $this->dbName.users WHERE user_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getIdPasswordByEmail($email)
    {
        $sql = "SELECT user_id, password FROM $this->dbName.users WHERE email = :email";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'email' => $email
        ];
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function isUserByEmail($email)
    {
        $sql = "SELECT EXISTS (SELECT 1 FROM $this->dbName.users WHERE email = :email) AS email_exists";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'email' => $email
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function isUserByUsername($username)
    {
        $sql = "SELECT EXISTS (SELECT 1 FROM $this->dbName.users WHERE username = :username) AS username_exists";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'username' => $username
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function insert($datas)
    {
        $sql = "INSERT INTO $this->dbName.users (
                first_name, 
                last_name, 
                username, 
                email, 
                password
            ) 
            VALUES (
                :first_name, 
                :last_name, 
                :username, 
                :email, 
                :password
            )";
        $params = [
            'first_name' => $datas['first_name'],
            'last_name' => $datas['last_name'],
            'username' => $datas['username'],
            'email' => $datas['email'],
            'password' => password_hash($datas['password'], PASSWORD_DEFAULT)
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
