<?php


function connect_db()
{
    try {
        $pdo = new PDO("mysql:host=localhost:8111;dbname=fast_food", 'root', 'root');
        // Thiết lập chế độ lỗi để bật chế độ ngoại lệ (exception) cho PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage());
    }
}

function user_exists($email)
{
    // Sử dụng PDO Prepared Statement để gắn tham số vào câu lệnh SQL
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE `email` = ?");
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

function get_user_by_id($user_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE `user_id` = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // đưa về một mảng kết hợp
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function add_user($data)
{

    $pdo = connect_db();
    try {
        // Chuẩn bị truy vấn SQL INSERT INTO
        $sql = "INSERT INTO khach_hang (name, email, pass, phone, address, time) VALUES (:name, :email, :pass, :phone, :address, :time)";
        // Liên kết các tham số trong truy vấn SQL với giá trị từ mảng $data
        $stmt = $pdo->prepare($sql);
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
        } else {
            echo "Không có dữ liệu nào được chèn vào bảng khách hàng.";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function update_user($data)
{
    $pdo = connect_db();
    try {
        // Chuẩn bị truy vấn SQL UPDATE
        $sql = "UPDATE khach_hang SET name = :name, user_img = :user_img, phone = :phone, address = :address WHERE user_id = :user_id";
        // Liên kết các tham số trong truy vấn SQL với giá trị từ mảng $data
        $stmt = $pdo->prepare($sql);
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
        } else {
            echo "Không có bản ghi nào được cập nhật trong bảng khách hàng.";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


function update_password($user_id, $old_password, $new_password)
{
    $pdo = connect_db();
    try {

        // Kiểm tra mật khẩu cũ trước khi cập nhật
        $stmt_check = $pdo->prepare("SELECT user_id FROM khach_hang WHERE user_id = :user_id AND pass = :old_password");
        $stmt_check->bindParam(':user_id', $user_id);
        $stmt_check->bindParam(':old_password', $old_password);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            // Mật khẩu cũ đúng, tiếp tục cập nhật mật khẩu mới
            $stmt_update = $pdo->prepare("UPDATE khach_hang SET pass = :new_password WHERE user_id = :user_id");
            $stmt_update->bindParam(':new_password', $new_password);
            $stmt_update->bindParam(':user_id', $user_id);
            $stmt_update->execute();

            if ($stmt_update->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}



global $error;
function check_login($email, $password)
{
    // Sử dụng PDO Prepared Statement để gắn tham số vào câu lệnh SQL
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE `email` = ? AND `pass` = ?");
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

function get_id_user($email)
{
    // Sử dụng PDO Prepared Statement để gắn tham số vào câu lệnh SQL
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE `email` = ?");
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

function get_list_product()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `san_pham`");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}

function get_list_category()
{
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM `danh_muc`");
    $stmt->execute();
    try {
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}


function get_product_by_id($product_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `san_pham` WHERE `product_id` = ?");
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        exit;
    }
}

function get_list_order()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `don_hang`");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}



// $user = get_user_by_id(3);

// print_r($user);

function get_total_money()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total_money'];
    }
    return false;
}

function get_total_order()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total_order'];
    }
    return false;
}

// Biến toàn cục
global $list_order;
$list_order = get_list_order();

function get_orders_by_user_id($user_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `don_hang` WHERE `user_id` = ? AND `status_order` <> 0 ORDER BY `bill_time` DESC");
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}


function get_orders_and_detail_by_user_id($user_id, $order_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `don_hang` JOIN `chi_tiet_don_hang` on  `don_hang`.order_id = `chi_tiet_don_hang`.order_id WHERE `user_id` = ? AND `don_hang`.order_id = ?");
        $stmt->execute([$user_id, $order_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}
if (isset($_SESSION['user_id'])) {
    global $list_order_user;
    $list_order_user = get_orders_by_user_id($_SESSION['user_id']);
    // global $list_order_and_detail;
    // $list_order_and_detail = get_orders_and_detail_by_user_id($_SESSION['user_id']);
}
