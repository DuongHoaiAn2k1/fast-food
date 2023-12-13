<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="public/css/style.css" />
    <title>Food Store</title>
    <style>
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #eee;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            z-index: 10000;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 20px;
            color: #333;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #000;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 30px;
            transform: rotate(45deg);
            cursor: pointer;
        }

        .menu-header {
            padding-left: 12px;

        }

        .menu-header h5 {
            font-weight: 600;
        }

        .menu-list {
            list-style-type: none;
        }

        .menu-list li a {
            font-size: 15px;
            padding: 0px;

        }

        .menu-list li:hover {
            text-decoration: underline;
            text-decoration-color: red;
            text-decoration-thickness: 2px;
            text-underline-offset: 4px;
        }
    </style>

<body>
    <header class=" text-white border-bottom-1">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-lg-0" href="#">
                        <img style="width: 80px; height: 80px" src="https://www.citypng.com/public/uploads/preview/fast-food-hamburger-restaurant-logo-11653270810nvqf84k7fx.png" height="55" alt="MDB Logo" loading="lazy" />
                    </a>
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/fast-food/Home">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/fast-food/Product/">THỰC ĐƠN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/fast-food/Introduce">GIỚI THIỆU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/fast-food/Contact">LIÊN HỆ</a>
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center" style="font-size: 22px;">
                    <!-- Icon -->
                    <a class="text-reset me-4" href="/fast-food/cart">
                        <i style="color: black;" class="fas fa-shopping-cart"></i>
                        <span id="total_oder_cart" class="badge rounded-pill badge-notification bg-danger"><?php echo isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info']['total_order'] : 0 ?></span>
                    </a>

                    <!-- Avatar -->
                    <div class="ms-2 me-2">
                        <a class=" d-flex align-items-center hidden-arrow" href="<?php echo empty($_SESSION['is_login']) ? '/fast-food/User/Login' : '/fast-food/User/Account';
                                                                                    ?>" id="navbarDropdownMenuAvatar" role="button">
                            <img src="data:image/png;base64,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" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                    </div>
                    <div class="dropdown ms-2">
                        <!-- <i style="color: black;" id="menu-icon " class="fa fa-bars menu-icon" aria-hidden="true"></i> -->
                        <button style="border: none; background: none; box-shadow: none;" id="menu-button" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i style="color: black;" class="fa fa-bars menu-icon" aria-hidden="true"></i></button>
                        <!-- <button style="border: none; background: none;" id="menu-button"><i style="color: black;" class="fa fa-bars menu-icon" aria-hidden="true"></i></button> -->
                    </div>

                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <!-- Navbar -->
    </header>

    <!-- <div class="sidebar" id="sidebar">
    <span class="close-button" id="close-button">+</span>
    <div class="contain-box">
      <div class="menu-header">
        <h5>DANH MỤC MÓN ĂN</h5>
      </div>
      <ul class="menu-list">
        <?php //foreach ($list_category as $item) {
        ?>
          <li><a href="?mod=product&category_id=<?php //echo $item['category_id'] 
                                                ?>" style="margin-bottom: 4px;" href="#"><?php //echo $item['category_name'] 
                                                                                            ?> ></a></li>
        <?php
        //} 
        ?>

      </ul>
    </div>
  </div> -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header menu-header">
            <h5>DANH MỤC MÓN ĂN</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="">
            <ul class="menu-list" style="margin-top: -10px;margin-left: -10px;">
                <?php
                require_once "./src/models/ProductModel.php";
                $product = new ProductModel();
                $list_category = $product->getCategories();
                foreach ($list_category as $item) {
                ?>
                    <li><a href="?mod=product&category_id=<?php echo $item['category_id']
                                                            ?>" style="margin-bottom: 4px; color: black; text-decoration: none;" href="#"><?php echo $item['category_name']
                                                                                                                                            ?> ></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="offcanvas-header menu-header">
            <h5>CHÂM NGÔN</h5>
        </div>
        <div>
            <ul style="margin-top: -10px;margin-left: -10px;">
                <li>Khám phá hương vị nhanh chóng!</li>
                <li>Thỏa lòng bất cứ lúc nào, bất cứ nơi đâu.</li>
                <li>Chất lượng đỉnh cao, thời gian phục vụ nhanh chóng.</li>
                <li>Mang hạnh phúc vào từng miếng thức ăn.</li>
                <li>Tạo nên hương vị đặc biệt mỗi ngày.</li>
            </ul>
        </div>

        <div class="offcanvas-header menu-header">
            <h5>LIÊN HỆ</h5>
        </div>
        <div>
            <ul class="menu-list" style="margin-top: -10px;margin-left: -10px;">
                <li style="list-style-type: none;"><a style="color: black; text-decoration: none;" href="?mod=contact&act=main">Liên hệ với chúng tôi</a></li>
            </ul>
        </div>
        <div class="offcanvas-header menu-header">
            <h5>LỜI CẢM ƠN</h5>
        </div>
        <div>
            <ul style="margin-top: -10px;margin-left: -10px;">
                <li style="list-style-type: none;">Cảm ơn các bạn đã tin tưởng và lựa chọn sản phẩm của cửa hàng!</li>
            </ul>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>