<?php
$pdo = connect_db();
$product_id = $_GET['product_id'];

$stmt = $pdo->prepare("DELETE FROM `san_pham` WHERE `product_id` = ? ");
try {
    $stmt->execute([$product_id]);
    echo "<script>alert('Xóa sản phẩm thành công'); setTimeout(()=>{window.location.href='?page=list_product';}, 500)</script>";
} catch (PDOException $e) {
    echo "Loi" . $e->getMessage();
}
