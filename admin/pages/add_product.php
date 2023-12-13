<?php


if (isset($_POST['btn-submit'])) {


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
    $category = $_POST['category'];
    $time_create = date("y/m/d h:m:s");
    // Handle image upload
    if (isset($_FILES['file'])) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
    }

    // Insert data into the database using a prepared statement
    $stmt = $pdo->prepare("INSERT INTO san_pham (product_name, short_des, price, img, category_id, time_create) VALUES (:product_name, :short_desc, :price, :img, :category_id, :time_create)");

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':short_desc', $short_desc);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $upload_file);
    $stmt->bindParam(':category_id', $category);
    $stmt->bindParam(':time_create', $time_create);

    try {
        $stmt->execute();
        echo '<script>alert("Thêm sản phẩm thành công");setTimeout(function(){window.location.href="?page=list_product";}, 500);</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}




?>
<?php require "./inc/header.php" ?>


<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price">
                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="short-desc" id="short-desc"></textarea>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="previewImage()">
                            <img id="image-preview" src="public/images/img-thumb.png">
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <select name="category">
                            <option value="">-- Chọn danh mục --</option>
                            <option value="1">Combo 1 người</option>
                            <option value="2">Combo nhóm</option>
                            <option value="3">Gà gán - Gà quay</option>
                            <option value="4">Burger - Cơm - Mì Ý</option>
                            <option value="5">Thức Uống & Tráng Miệng</option>
                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
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
            imagePreview.src = 'public/images/img-thumb.png'; // Mặc định nếu không có tệp nào được chọn
        }
    }
</script>

<?php
require './inc/footer.php';
?>