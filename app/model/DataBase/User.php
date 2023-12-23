<?php

require_once './app/model/DataBase/DataBase.php';

class User extends DataBase
{
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
        return $stmt->fetch();
    }

    public function isUserByUsername($username)
    {
        $sql = "SELECT EXISTS (SELECT 1 FROM $this->dbName.users WHERE username = :username) AS username_exists";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'username' => $username
        ];
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function insert($datas)
    {
        $sql = "INSERT INTO Users (
                first_name, 
                last_name, 
                username, 
                email, 
                password, 
                status
            ) 
            VALUES (
                :first_name, 
                :last_name, 
                :username, 
                :email, 
                :password, 
                :status
            )";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'first_name' => $datas['first_name'],
            'last_name' => $datas['last_name'],
            'username' => $datas['username'],
            'email' => $datas['email'],
            'password' => $datas['password']
        ];
        $stmt->execute($params);
    }
}
