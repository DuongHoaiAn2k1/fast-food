<?php require "./inc/header.php" ?>
<?php
if (isset($_GET['s'])) {
    $list_user = get_list_user_by_name($_GET['s']);
} else {
    $list_user = get_list_user();
}

?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?page=list_customer">Tất cả <span class="count">(<?php $sum = count_user();
                                                                                                        echo $sum; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="page" value="list_customer" style="display: none;">
                            <input type="text" name="s" id="s" autocomplete="off">
                            <input type="submit">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">

                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list_user)) {
                                    $i = 0;
                                    foreach ($list_user as $item) {
                                        $i++;
                                ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $i ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <?php echo $item['name'] ?>
                                                </div>
                                                <!-- <ul class="list-operation fl-right">
                                                <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul> -->
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['phone'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['email'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['address'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['time'] ?></span></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<script>alert('Không tìm thấy')</script>";
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

<?php require "./inc/footer.php" ?>