<?php

namespace App\Model\DataBase;

use App\Model\DataBase\DataBase;

class OrderItems extends DataBase
{
    public function getAddressByOrderId($id)
    {
        $sql = "SELECT address_id FROM $this->dbName.orders WHERE order_id = :order_id AND status = 'active'";
        $params = [
            'order_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function getProductByOrderId($id)
    {
        $sql = "SELECT * 
            FROM $this->dbName.orderitems as oi
            INNER JOIN $this->dbName.products AS p
            ON p.product_id = oi.product_id
            WHERE p.status = 'active' AND oi.order_id = :order_id AND oi.status = 'active'";
        $params = [
            'order_id' => $id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function isItemGetQuantity($product_id, $order_id)
    {
        $sql = "SELECT quantity FROM $this->dbName.orderitems WHERE product_id = :product_id AND order_id = :order_id AND status = 'active'";
        $params = [
            'product_id' => $product_id,
            'order_id' => $order_id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function updateQuantity($order_id, $product_id, $quantity)
    {
        $sql = "UPDATE 
            $this->dbName.orderitems 
        SET 
            quantity = :quantity 
        WHERE 
            order_id = :order_id AND product_id = :product_id AND status = 'active'";
        $params = [
            'quantity' => $quantity,
            'order_id' => $order_id,
            'product_id' => $product_id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function deleteItem($product_id)
    {
        $sql = "UPDATE 
            $this->dbName.orderitems 
        SET 
            status = 'inactive' 
        WHERE
            product_id = :product_id";
        $params = [
            'product_id' => $product_id
        ];
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
        } catch (\PDOException $e) {
            throw new \Exception('User insertion failed: ' . $e->getMessage());
        }
    }

    public function insert($order_id, $product_id, $quantity, $price)
    {
        $sql = "INSERT INTO $this->dbName.orderitems (
                order_id, 
                product_id, 
                quantity, 
                price
            ) 
            VALUES (
                :order_id, 
                :product_id,
                :quantity, 
                :price
            )";
        $params = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price
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
