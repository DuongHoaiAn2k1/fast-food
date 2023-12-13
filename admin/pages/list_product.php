<?php
if (isset($_GET['sold_out'])) {
    if ($_GET['sold_out'] == 'false') {
        $pdo = connect_db();
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        // Perform a SELECT query to retrieve products
        $query = "SELECT * FROM san_pham WHERE `sold_out` = 0";
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $pdo = null;
    } else {
        $pdo = connect_db();
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        // Perform a SELECT query to retrieve products
        $query = "SELECT * FROM san_pham WHERE `sold_out` = 1";
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $pdo = null;
    }
} else if (isset($_GET['s'])) {
    $s = '%' . $_GET['s'] . '%';
    $pdo = connect_db();
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    // Perform a SELECT query to retrieve products
    $query = "SELECT * FROM san_pham WHERE `product_name` LIKE :search";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':search', $s, PDO::PARAM_STR);
    try {
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
} else {
    $pdo = connect_db();
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    // Perform a SELECT query to retrieve products
    $query = "SELECT * FROM san_pham";
    $stmt = $pdo->prepare($query);
    try {
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}

require './inc/header.php';
?>
<style>
    #scroll-container {
        height: 500px;
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
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?page=add_product" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?page=list_product">Tất cả <span class="count">(<?php $s = count_product();
                                                                                                        echo $s; ?>)</span></a> |</li>
                            <li class="publish"><a href="?page=list_product&sold_out=false">Còn hàng <span class="count">(<?php $s = count_product_sell();
                                                                                                                            echo $s; ?>)</span></a> |</li>
                            <li class="pending"><a href="?page=list_product&sold_out=true">Hết hàng<span class="count">(<?php $s = count_product_sold_out();
                                                                                                                        echo $s; ?>)</span> </a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s" autocomplete="off">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">

                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="scroll-container">

                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($products as $product) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><span class="tbody-text">&ensp;<?php echo $i ?></h3></span>
                                            <td><span class="tbody-text">&ensp;&ensp;&ensp;&ensp;<?php echo $product['product_id'] ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $product['img'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <?php echo $product['product_name'] ?>
                                                </div>

                                            </td>
                                            <td><span class="tbody-text"><?php echo currency_format($product['price']) ?></span></td>
                                            <?php
                                            $category = get_category($product['category_id']);
                                            $category_name = $category['category_name'];
                                            ?>
                                            <td><span class="tbody-text"><?php echo $category_name ?></span></td>
                                            <td><span class="tbody-text"><?php echo !$product['sold_out'] ? 'Còn hàng' : 'Hết hàng' ?></span></td>

                                            <td><span class="tbody-text">Admin</span></td>
                                            <td>
                                                <span class="tbody-text"><?php echo $product['time_create'] ?></span>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?page=update_product&product_id=<?php echo $product['product_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?page=delete_product&product_id=<?php echo $product['product_id'] ?>" product-id="<?php echo $product['product_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
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

<script>
    const deleteLinks = document.querySelectorAll(".delete");
    deleteLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();

            const confirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm?");
            if (confirmed) {
                window.location.href = link.getAttribute("href");
            }
        })
    })
</script>

<?php
require './inc/footer.php';
?>