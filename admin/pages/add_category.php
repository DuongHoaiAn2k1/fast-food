<?php
global $error;
$error = array();

$pdo = connect_db();
if (isset($_POST['btn-submit'])) {
    if (empty($_POST['category_name'])) {
        $error['category_name'] = "Tên danh mục không được để trống!!";
    } else {
        $category_name = $_POST['category_name'];
    }

    if (isset($_FILES['file'])) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
    }

    $time_create = date("y/m/d h:m:s");
    if (empty($error)) {

        $stmt = $pdo->prepare("INSERT INTO danh_muc (category_name, img_cat, time_create_cat) VALUES (:category_name, :img_cat, :time_create_cat)");

        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':img_cat', $upload_file);
        $stmt->bindParam(':time_create_cat', $time_create);
        try {
            $stmt->execute();
            echo '<script>alert("Thêm danh mục thành công");setTimeout(function(){window.location.href="?page=list_category";}, 500);</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $pdo = null;
    }
}



require './inc/header.php';
?>



<style>
    .error {
        margin-top: -10px;
    }
</style>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="category_name" id="title" value="<?php if (isset($_POST['btn-submit'])) echo $_POST['category_name'] ?>">
                        <?php echo form_error('category_name') ?>
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="previewImage()">
                            <img id="image-preview" src="public/images/img-thumb.png">
                        </div>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm</button>
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

            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

        } else {
            imagePreview.src = 'public/images/img-thumb.png'; // Mặc định nếu không có tệp nào được chọn
        }
    }
</script>

<?php
require './inc/footer.php';
?>