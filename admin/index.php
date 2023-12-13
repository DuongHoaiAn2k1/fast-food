<?php
session_start();
include "./helper/data.php";
include "./helper/url.php";
include "./database/admin.php";
include "./database/database.php";
include "./helper/user.php";


$page = isset($_GET['page']) ? $_GET['page'] : 'list_product';
if (empty($_SESSION['is_admin_login']) && $page != 'login') {
    redirect('?page=login');
}

$path = "./pages/{$page}.php";

if (file_exists($path)) {
    require "{$path}";
} else {
    echo "Trang không tồn tại";
}
