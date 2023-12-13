<?php
require './inc/header.php';
$order_id = $_GET['order_id'];
$list_detail = get_list_order_and_detail_by_id($_GET['user_id'], $order_id);
// show_array($list_detail);
$order = get_order_by_id($_GET['order_id']);
$user = get_user_by_id($order_id);
// show_array($list_detail);

if (isset($_POST['sm_status'])) {
    // echo "<script> alert('Chó hào')</script>";
    $status = $_POST['status'];
    $pdo = connect_db();
    $stmt = $pdo->prepare("UPDATE `don_hang` set `status_order` = :status_order WHERE `order_id` = :order_id");
    $stmt->bindParam(':status_order', $status);
    $stmt->bindParam(':order_id', $order_id);
    try {
        $stmt->execute();
        // echo '<script>alert("Cập nhật đơn hàng thành công"); location.reload();;</script>';
        echo '<script>alert("Cập nhật đơn hàng thành công thành công");setTimeout(function(){window.location.href="?page=detail_order&order_id=' . $order_id . '&user_id=' . $_GET['user_id'] . '";}, 500);</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng: #<?php echo $_GET['order_id'] ?></h3>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $user['address'] 
                                                                                                    ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thanh toán tại nhà</span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option <?php if ($order['status_order'] === 0) echo "selected='selected'" ?> value='0'>Đã hủy</option>
                                <option <?php if ($order['status_order'] === 1) echo "selected='selected'" ?> value='1'>Đã đặt</option>
                                <option <?php if ($order['status_order'] === 2) echo "selected='selected'" ?> value='2'>Đang vận chuyển</option>
                                <option <?php if ($order['status_order'] === 3) echo "selected='selected'" ?> value='3'>Đã chuyển</option>
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($list_detail as $item) {
                                $product = get_product_by_id($item['product_id']);
                                // show_array($product);
                                $i++;
                            ?>
                                <tr>
                                    <td class="thead-text"><?php echo $i ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="<?php echo $product['img'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?php echo $product['product_name']  ?></td>
                                    <td class="thead-text"><?php echo currency_format($product['price'])  ?></td>
                                    <td class="thead-text"><?php echo $item['quantity']  ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['price'])  ?></td>
                                </tr>
                            <?php
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng giá trị đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $order['total_order'] ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($order['total_cost']) ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require './inc/footer.php';
?>