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
}
