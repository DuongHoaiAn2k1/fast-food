<?php

class UserModel extends DB
{
    public function check_login($email, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `khach_hang` WHERE `email` = ? AND `pass` = ?");
            $stmt->execute([$email, $password]);
            $check_user = $stmt->rowCount();
            if ($check_user > 0) {
                echo "Đăng nhập thành công";
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Đăng nhập thất bại" . $e->getMessage();
        }
    }

    public function add_user($data)
    {
        try {

            $sql = "INSERT INTO khach_hang (name, email, pass, phone, address, time) VALUES (:name, :email, :pass, :phone, :address, :time)";
            // Liên kết các tham số trong truy vấn SQL với giá trị từ mảng $data
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':pass', $data['pass']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':time', $data['time']);

            //Thực thi truy vấn
            $stmt->execute();

            // Kiểm tra xem truy vấn đã thành công hay không
            if ($stmt->rowCount() > 0) {
                echo "Dữ liệu đã được chèn thành công vào bảng khách hàng.";
                return true;
            } else {
                echo "Không có dữ liệu nào được chèn vào bảng khách hàng.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function user_exists($email)
    {

        try {
            $stmt = $this->conn->prepare("SELECT * FROM `khach_hang` WHERE `email` = ?");
            $stmt->execute([$email]);
            $check_user = $stmt->rowCount();
            if ($check_user > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo 'Lỗi thực thi truy vấn' . $e->getMessage();
        }
    }

    public function get_id_user($email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `khach_hang` WHERE `email` = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['user_id'];
            }
            return null;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            exit;
        }
    }

    public function get_user_by_id($user_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `khach_hang` WHERE `user_id` = ?");
            $stmt->execute([$user_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // đưa về một mảng kết hợp
            return $result;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function update_user($data)
    {

        try {
            $sql = "UPDATE khach_hang SET name = :name, user_img = :user_img, phone = :phone, address = :address WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $data['user_id']); // Đảm bảo rằng bạn cung cấp ID để xác định bản ghi cần cập nhật
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':user_img', $data['user_img']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);

            // Thực thi truy vấn
            $stmt->execute();

            // Kiểm tra xem truy vấn đã thành công hay không
            if ($stmt->rowCount() > 0) {
                echo "Dữ liệu đã được cập nhật thành công trong bảng khách hàng.";
                return true;
            } else {
                echo "Không có bản ghi nào được cập nhật trong bảng khách hàng.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
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

    public function get_orders_by_user_id($user_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM `don_hang` WHERE `user_id` = ? AND `status_order` <> 0 ORDER BY `bill_time` DESC");
            $stmt->execute([$user_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Loi truy van" . $e->getMessage();
        }
    }
}
