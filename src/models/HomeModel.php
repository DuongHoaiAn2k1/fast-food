<?php

class HomeModel extends DB
{
    public function getProducts()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM san_pham");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function getCategories()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM danh_muc");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }
}
