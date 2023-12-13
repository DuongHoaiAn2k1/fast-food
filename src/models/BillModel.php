<?php

class BillModel extends DB
{
    public function create()
    {
        $total_cost = $_SESSION['cart']['info']['total_money'];
        $total_order = $_SESSION['cart']['info']['total_order'];
        $user_id = $_SESSION['user_id'];
        $bill_time = $_SESSION['time_create_bill'];


        // Insert data into the database using a prepared statement
        $stmt = $this->conn->prepare("INSERT INTO don_hang (total_cost, total_order, user_id, bill_time) VALUES (:total_cost, :total_order, :user_id, :bill_time)");

        $stmt->bindParam(':total_cost', $total_cost);
        $stmt->bindParam(':total_order', $total_order);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':bill_time', $bill_time);
        try {
            $stmt->execute();
            // echo '<script>alert("Thanh toán thành công");setTimeout(function(){window.location.href="?";}, 500);</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        //Lay danh sach hoa don
        $list_order = $this->get_list_order();

        $order_id = (int) $list_order[sizeof($list_order) - 1]['order_id'] + 1;

        $stmt = $this->conn->prepare("INSERT INTO chi_tiet_don_hang (product_id, order_id, quantity, price) VALUES (:product_id, :order_id, :quantity, :price)");
        foreach ($_SESSION['cart']['buy'] as $item) {
            $stmt->bindParam(':product_id', $item['product_id']);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':quantity', $item['qty']);
            $stmt->bindParam(':price', $item['price']);

            try {
                $stmt->execute();
                echo '<script>alert("Thanh toán thành công");setTimeout(function(){window.location.href="/fast-food/User/Account";}, 500);</script>';
                unset($_SESSION['cart']);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit();
            }
        }

        // Close the database connection
        $pdo = null;
    }

    public function get_list_order()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `don_hang`");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Loi truy van" . $e->getMessage();
        }
    }

    public function get_orders_and_detail_by_user_id($user_id, $order_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `don_hang` JOIN `chi_tiet_don_hang` on  `don_hang`.order_id = `chi_tiet_don_hang`.order_id WHERE `user_id` = ? AND `don_hang`.order_id = ?");
            $stmt->execute([$user_id, $order_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Loi truy van" . $e->getMessage();
        }
    }

    public function Cancel($order_id)
    {

        try {
            $stmt = $this->conn->prepare("UPDATE `don_hang` SET `status_order` = 0 WHERE `order_id` = ?");
            $stmt->execute([$order_id]);
            echo "<script>alert('Hủy đơn hàng thành công'); setTimeout(()=>{window.location.href='/fast-food/User/Account';}, 500)</script>";
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            exit;
        }
    }
}
