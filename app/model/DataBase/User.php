<?php

require_once './app/model/DataBase/DataBase.php';

class User extends DataBase
{
    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->dbName.users";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
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

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->dbName.users WHERE email = :email";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'email' => $email
        ];
        $stmt->execute($params);
        return $stmt->fetch();
    }
}
