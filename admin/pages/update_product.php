<?php

$product = get_product($_GET['product_id']);

// show_array($product);

if (isset($_POST['btn-update'])) {

    // show_array($_POST);

    $pdo = connect_db();
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    // Get form data
    $product_name = $_POST['product_name'];
    $short_desc = $_POST['short-desc'];
    $price = $_POST['price'];
    $sold_out = $_POST['sold_out'];
    $category = $_POST['category'];
    $time_create = date("y/m/d h:m:s");

    // Handle image upload
    if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
    } else {
        $upload_file = $product['img'];
    }

    // Update data in the database using a prepared statement
    $stmt = $pdo->prepare("UPDATE `san_pham` SET `product_name` = :product_name, `short_des` = :short_desc, `price` = :price, `img` = :img, `sold_out` = :sold_out, `category_id` = :category_id, `time_create` = :time_create WHERE product_id = :product_id");

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':short_desc', $short_desc);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $upload_file);
    $stmt->bindParam(':sold_out', $sold_out);
    $stmt->bindParam(':category_id', $category);
    $stmt->bindParam(':time_create', $time_create);
    $stmt->bindParam(':product_id', $product['product_id']); // Thêm tham số cho ID sản phẩm

    try {
        $stmt->execute();
        echo '<script>alert("Cập nhật sản phẩm thành công");setTimeout(function(){window.location.href="?page=list_product";}, 500);</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}




require './inc/header.php';
?>


<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo $product['product_name'] ?>">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo $product['price'] ?>">
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="short-desc" id="short-desc"><?php echo $product['short_des'] ?></textarea>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="previewImage()">
                            <img id="image-preview" src="<?php echo $product['img'] ?>">
                        </div>
                        <label>Trạng thái sản phẩm</label>
                        <select name="sold_out">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="0" <?php if ($product['sold_out'] === 0) echo "selected" ?>>Còn hàng</option>
                            <option value="1" <?php if ($product['sold_out'] === 1) echo "selected" ?>>Hết hàng</option>
                        </select>
                        <label>Danh mục sản phẩm</label>
                        <select name="category">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1" <?php if ($product['category_id'] === 1) echo "selected" ?>>Combo 1 người</option>
                            <option value="2" <?php if ($product['category_id'] === 2) echo "selected" ?>>Combo nhóm</option>
                            <option value="3" <?php if ($product['category_id'] === 3) echo "selected" ?>>Gà gán - Gà quay</option>
                            <option value="4" <?php if ($product['category_id'] === 4) echo "selected" ?>>Burger - Cơm - Mì Ý</option>
                            <option value="5" <?php if ($product['category_id'] === 5) echo "selected" ?>>Thức Uống & Tráng Miệng</option>
                        </select>
                        <button type="submit" name="btn-update" id="btn-update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        var input = document.getElementById('upload-thumb');
        var imagePreview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            // FileReader : được dùng để đọc tệp hình ảnh
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Mặc định nếu không có tệp nào được chọn
        }
    }
</script>

<?php
require './inc/footer.php';
?>