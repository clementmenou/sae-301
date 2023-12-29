<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Product extends DataBase
{
    public function getAllUsers()
    {
        $sql = "SELECT * FROM $this->dbName.products WHERE status = 'active'";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }
}
