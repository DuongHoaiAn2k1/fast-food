<?php
$category_id = $_GET['category_id'];
$pdo = connect_db();
$stmt = $pdo->prepare("DELETE FROM `danh_muc` WHERE `category_id` = ?");

try {
    $stmt->execute([$category_id]);
    echo "<script>alert('Xóa danh mục thành công'); setTimeout(()=>{window.location.href='?page=list_category';}, 500)</script>";
} catch (PDOException $e) {
    echo "Loi khi xoa" . $e->getMessage();
}
