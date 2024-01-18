<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class Product extends DataBase
{
    public function getById($id)
    {
        $sql = "SELECT * FROM $this->dbName.products WHERE product_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetch();
    }

    public function getPriceById($id)
    {
        $sql = "SELECT price FROM $this->dbName.products WHERE product_id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'id' => $id
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getImgById($id)
    {
        $sql = "SELECT image FROM $this->dbName.products WHERE product_id = :id";
        $params = [
            'id' => $id
        ];
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getIdByName($name)
    {
        $sql = "SELECT product_id FROM $this->dbName.products WHERE name = :name AND status = 'active'";
        $params = [
            'name' => $name
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function getProductsByCategory($category)
    {
        $sql = "SELECT *
        FROM $this->dbName.products AS p
        INNER JOIN $this->dbName.productcategories AS pc
        ON p.product_id = pc.product_id
        INNER JOIN $this->dbName.categories AS c
        ON pc.category_id = c.category_id
        WHERE p.status = 'active' AND pc.status = 'active' AND c.name = :category";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'category' => $category
        ];
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getQuantityById($id)
    {
        $sql = "SELECT stock_quantity FROM $this->dbName.products WHERE product_id = :id";
        $params = [
            'id' => $id
        ];
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function getAllProduct()
    {
        $sql = "SELECT DISTINCT p.*
        FROM $this->dbName.products AS p
        INNER JOIN $this->dbName.productcategories AS pc
        ON p.product_id = pc.product_id
        INNER JOIN $this->dbName.categories AS c
        ON pc.category_id = c.category_id
        WHERE p.status = 'active' AND pc.status = 'active'";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    public function getAllNames()
    {
        $sql = "SELECT name FROM $this->dbName.products WHERE status = 'active'";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    public function updateQuantity($datas)
    {
        $sql = "UPDATE 
                $this->dbName.products
            SET
                stock_quantity = :stock_quantity
            WHERE 
                product_id = :product_id";
        $params = [
            'stock_quantity' => $datas['stock_quantity'],
            'product_id' => $datas['product_id']
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function isProductByName($name)
    {
        $sql = "SELECT EXISTS (SELECT 1 FROM $this->dbName.products WHERE name = :name AND status = 'active') AS name_exists";
        $stmt = $this->getConnection()->prepare($sql);
        $params = [
            'name' => $name
        ];
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function insert($datas)
    {
        $sql = "INSERT 
            INTO 
                $this->dbName.products (name, description, price, stock_quantity, image)
            VALUES
                (:name, :description, :price, :stock_quantity, :image)";
        $params = [
            'name' => $datas['name'],
            'description' => $datas['description'],
            'price' => $datas['price'],
            'stock_quantity' => $datas['stock_quantity'],
            'image' => $datas['image']
        ];
        try {
            // Transaction for multiples request
            $this->getConnection()->beginTransaction();
            $this->getConnection()->prepare($sql)->execute($params);
            $productId = $this->getConnection()->lastInsertId();
            $this->getConnection()->commit();

            return $productId;
        } catch (\PDOException $e) {
            // Cancel if error in transaction
            $this->getConnection()->rollBack();
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE $this->dbName.products SET status = 'inactive' WHERE product_id = :product_id";
        $params = [
            'product_id' => $id
        ];
        try {
            $this->getConnection()->prepare($sql)->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }
}
