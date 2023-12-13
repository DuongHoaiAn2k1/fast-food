<?php
function check_admin_login($username, $password)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?");
        $stmt->execute([$username, $password]);
        $checkAdmin = $stmt->rowCount();
        if ($checkAdmin > 0) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        echo "Dang nhap that bai" . $e->getMessage();
    }
}

function get_infor_admin($username)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * `admin` WHERE `username` = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}


function get_category($category_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare(("SELECT * FROM `danh_muc` WHERE `category_id` = ?"));
        $stmt->execute([$category_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}

function get_product($product_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `san_pham` WHERE `product_id` = ?");
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}

function get_list_order_and_detail()
{
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM `don_hang` JOIN `chi_tiet_don_hang` on `don_hang`.order_id = `chi_tiet_don_hang`.order_id");
    $stmt->execute();
    try {
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}

// Lấy danh sách đơn hàng và chi tiết của từng đơn hàng theo mã người dùng
function get_list_order_and_detail_by_id($user_id, $order_id)
{
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM `don_hang` JOIN `chi_tiet_don_hang` on `don_hang`.order_id = `chi_tiet_don_hang`.order_id WHERE `don_hang`.user_id = ? AND `don_hang`.order_id = ?");
    $stmt->execute([$user_id, $order_id]);
    try {
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Loi truy van" . $e->getMessage();
    }
}

// Lấy danh sách người dùng có trên hệ thống
function get_list_user()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang`");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}

function get_list_user_by_name($search_name)
{
    $pdo = connect_db();
    try {
        $search_name = '%' . $search_name . '%';
        $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE name Like ?");
        $stmt->execute([$search_name]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}



// Lấy đơn hàng theo mã đơn hàng
function get_order_by_id($order_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `don_hang` WHERE `order_id` = ?");
        $stmt->execute([$order_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Truy van that bai" . $e->getMessage();
    }
}

// function get_user_by_id($user_id)
// {
//     $pdo = connect_db();
//     try {
//         $stmt = $pdo->prepare("SELECT * FROM `khach_hang` WHERE `user_id` = ?");
//         $stmt->execute([$user_id]);
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
//         return $result;
//     } catch (PDOException $e) {
//         echo "Truy van that bai" . $e->getMessage();
//     }
// }
function get_product_by_product_id($product_id)
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT * FROM `san_pham` WHERE `product_id` = ?");
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_user()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `khach_hang`");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_product()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `san_pham`");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_product_sell()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `san_pham` WHERE `sold_out` = 0");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_product_sold_out()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `san_pham` WHERE `sold_out` = 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_orders()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `don_hang` ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function get_list_order_desc($bill_day = 'all')
{
    $pdo = connect_db();
    try {
        if ($bill_day === 'all') {
            $stmt = $pdo->prepare("SELECT * FROM `don_hang` ORDER BY `bill_time` DESC");
        } else {
            $stmt = $pdo->prepare("SELECT * FROM `don_hang` WHERE DATE(`bill_time`) = :bill_day ORDER BY `bill_time` DESC");
            $stmt->bindParam(':bill_day', $bill_day, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
    }
}


function count_orders_ordered()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `don_hang` WHERE `status_order` = 1 ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_orders_ship()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `don_hang` WHERE `status_order` = 2 ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_orders_pay()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `don_hang` WHERE `status_order` = 3 ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function count_orders_cancel()
{
    $pdo = connect_db();
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `don_hang` WHERE `status_order` = 0 ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

function sum_total_cost_pay()
{
    // Kết nối đến cơ sở dữ liệu
    $db = connect_db();

    // Thực hiện truy vấn
    $stmt = $db->prepare("SELECT SUM(total_cost) as total FROM don_hang WHERE status_order = 3");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Đóng kết nối đến cơ sở dữ liệu
    $db = null;

    return $result['total'];
}
