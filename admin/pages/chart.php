<!DOCTYPE html>
<html>

<head>
    <title>ADMIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix" style="height: 54px;">
                    <a style="margin-top: -4px;" href="?page=list_post" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?page=list_category" title="">Danh mục</a>
                        </li>
                        <li>
                            <a href="?page=list_product" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=add_product" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?page=list_product" title="">Danh sách sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=list_order" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?page=list_customer" title="">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="public/images/img-admin.png">
                            </div>
                            <h3 id="account" class="fl-right"><?php //echo  $_SESSION['admin_login'] 
                                                                ?></h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?page=logout" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

            <style>
                .radius-10 {
                    border-radius: 10px !important;
                }

                .border-info {
                    border-left: 5px solid #0dcaf0 !important;
                }

                .border-danger {
                    border-left: 5px solid #fd3550 !important;
                }

                .border-success {
                    border-left: 5px solid #15ca20 !important;
                }

                .border-warning {
                    border-left: 5px solid #ffc107 !important;
                }


                .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 0px solid rgba(0, 0, 0, 0);
                    border-radius: .25rem;
                    margin-bottom: 1.5rem;
                    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
                }

                .bg-gradient-scooter {
                    background: #17ead9;
                    background: -webkit-linear-gradient(45deg, #17ead9, #6078ea) !important;
                    background: linear-gradient(45deg, #17ead9, #6078ea) !important;
                }

                .widgets-icons-2 {
                    width: 56px;
                    height: 56px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: #ededed;
                    font-size: 27px;
                    border-radius: 10px;
                }

                .rounded-circle {
                    border-radius: 50% !important;
                }

                .text-white {
                    color: #fff !important;
                }

                .ms-auto {
                    margin-left: auto !important;
                }

                .bg-gradient-bloody {
                    background: #f54ea2;
                    background: -webkit-linear-gradient(45deg, #f54ea2, #ff7676) !important;
                    background: linear-gradient(45deg, #f54ea2, #ff7676) !important;
                }

                .bg-gradient-ohhappiness {
                    background: #00b09b;
                    background: -webkit-linear-gradient(45deg, #00b09b, #96c93d) !important;
                    background: linear-gradient(45deg, #00b09b, #96c93d) !important;
                }

                .bg-gradient-blooker {
                    background: #ffdf40;
                    background: -webkit-linear-gradient(45deg, #ffdf40, #ff8359) !important;
                    background: linear-gradient(45deg, #ffdf40, #ff8359) !important;
                }
            </style>

            <div id="main-content-wp" class="list-post-page">
                <div class="wrap clearfix">
                    <?php require 'inc/sidebar.php'; ?>
                    <div id="content" class="fl-right">
                        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                                <div class="col">
                                    <div class="card radius-10 border-start border-0 border-3 border-info">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary">Số đơn đặt hàng</p>
                                                    <h4 class="my-1 text-info"><?php $s = count_orders_pay();
                                                                                echo $s; ?></h4>
                                                </div>
                                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary">Tổng doanh thu</p>
                                                    <h4 class="my-1 text-danger"><?php $total = sum_total_cost_pay();
                                                                                    echo currency_format($total) ?></h4>
                                                </div>
                                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-dollar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card radius-10 border-start border-0 border-3 border-success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary">Số lượng đơn hủy</p>
                                                    <h4 class="my-1 text-success"><?php $total_cancel = count_orders_cancel();
                                                                                    echo $total_cancel; ?></h4>
                                                </div>
                                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-ban"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-secondary">Số lượng người dùng</p>
                                                    <h4 class="my-1 text-warning"><?php $total_user = count_user();
                                                                                    echo $total_user; ?></h4>
                                                </div>
                                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer-wp" style="height: 44px;">
                <div class="wp-inner">
                    <p id="copyright">© 2023 Tác giả:
                        <span>Dương Hoài Ân - B2014552</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>