<?php
require './inc/header.php';
?>
<?php
if (isset($_GET['day'])) {
    if ($_GET['day'] == 'today') {
        $currentDate = date('Y-m-d');
        $list_order = get_list_order_desc($currentDate);
    } else {
        $list_order = get_list_order_desc();
    }
} else {
    $list_order = get_list_order_desc();
}

// show_array($list_order)
?>
<style>
    #scroll-container {
        height: 400px;
        overflow: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #fff;
        /* Màu nền của phần head */
        position: sticky;
        top: 0;
    }

    th {
        text-align: left;
        padding: 8px 10px;
        /* Các thuộc tính CSS khác cho phần đầu bảng */
    }

    tbody {
        height: 200px;
        /* Đặt chiều cao cho phần body để tạo thanh cuộn */
        overflow: auto;
    }
</style>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php $s = count_orders();
                                                                                    echo $s; ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã đặt <span class="count">(<?php $s = count_orders_ordered();
                                                                                        echo $s; ?>)</span></a> |</li>
                            <li class="pending"><a href="">Đang giao<span class="count">(<?php $s = count_orders_ship();
                                                                                            echo $s; ?>)</span> |</a></li>
                            <li class="pending"><a href="">Đã giao<span class="count">(<?php $s = count_orders_pay();
                                                                                        echo $s; ?>)</span></a></li>
                            <li class="pending"><a href="">Đã hủy<span class="count">(<?php $s = count_orders_cancel();
                                                                                        echo $s; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">

                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="?page=list_order" class="form-actions">
                            <input type="text" name="page" value="list_order" style="display: none;">
                            <select name="day">
                                <option value="all">Tất cả</option>
                                <option value="today" <?php if (isset($_GET['day']) && $_GET['day'] == 'today') echo 'selected'; ?>>Hôm nay</option>
                            </select>
                            <input type="submit">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="scroll-container">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã đơn hàng</span></td>
                                        <td><span class="thead-text">Họ và tên</span></td>
                                        <td><span class="thead-text">Số sản phẩm</span></td>
                                        <td><span class="thead-text">Tổng giá</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Chi tiết</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($list_order as $item) {
                                        $user = get_user_by_id($item['user_id']);
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $i; ?></h3></span>
                                            <td><span class="tbody-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#<?php echo $item['order_id'] ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <?php echo $user['name']  ?>
                                                </div>
                                                <!-- <ul class="list-operation fl-right">
                                                <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul> -->
                                            </td>
                                            <td><span class="tbody-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $item['total_order'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_cost']) ?></span></td>
                                            <td><span class="tbody-text">&nbsp;&nbsp;<?php
                                                                                        if ($item['status_order'] == 1) {
                                                                                            echo "Đã đặt";
                                                                                        } else if ($item['status_order'] == 2) {
                                                                                            echo "Đang giao";
                                                                                        } else if ($item['status_order'] == 3) {
                                                                                            echo "Đã chuyển";
                                                                                        } else {
                                                                                            echo "Đã hủy";
                                                                                        }
                                                                                        ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['bill_time']  ?></span></td>
                                            <td><a href="?page=detail_order&order_id=<?php echo $item['order_id'] ?>&user_id=<?php echo $item['user_id'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
require './inc/footer.php';
?>