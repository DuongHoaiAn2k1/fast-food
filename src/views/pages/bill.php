<?php
require_once "./src/models/UserModel.php";
$userModel = new UserModel();
$user = $userModel->get_user_by_id($_SESSION['user_id']);
$now = new DateTime();
$_SESSION['time_create_bill'] = $now->format('Y/m/d H:i:s');
$list_order = $userModel->get_list_order();
?>

<div id="head-main-page" class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">HÓA ĐƠN >> <strong>ID: #<?php echo $list_order[sizeof($list_order) - 1]['order_id'] + 1; ?></strong></p>
                    </div>
                    <div class="col-xl-3 float-end">
                        <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                        <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <!-- <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i> -->
                            <!-- <p class="pt-0">MDBootstrap.com</p> -->
                            <h3 style="font-weight: 600;">THÔNG TIN ĐẶT HÀNG</h3>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?php echo $user['name'] ?></span></li>
                                <li class="text-muted"><?php echo $user['address'] ?></li>
                                <li class="text-muted"><i class="fas fa-phone"></i> <?php echo $user['phone'] ?></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">HÓA ĐƠN</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#<?php echo $list_order[sizeof($list_order) - 1]['order_id'] + 1; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span><?php echo $_SESSION['time_create_bill'] ?></li>

                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">SẢN PHẨM</th>
                                    <th scope="col">SỐ LƯỢNG</th>
                                    <th scope="col">GIÁ</th>
                                    <th scope="col">TỔNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                if (isset($_SESSION['cart']['buy'])) {
                                    foreach ($_SESSION['cart']['buy'] as $item) {
                                        $i++;
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $item['product_name'] ?></td>
                                            <td> &emsp;&ensp;<?php echo $item['qty'] ?></td>
                                            <td><?php echo $this->currency_format($item['price']) ?></td>
                                            <td><?php echo $this->currency_format($item['sub_total']) ?></td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>

                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3"></p>

                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">

                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> TỔNG TIỀN:</span><span style="font-size: 25px;"><?php echo $this->currency_format(isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info']['total_money'] : '') ?></span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Cảm ơn vì đã mua hàng ^^</p>
                        </div>
                        <div class="col-xl-2">
                            <a href="/fast-food/Cart/createBill" type="button" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;">THANH TOÁN</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<?php
// show_array($list_order);

// show_array($list_order_user);
// echo "--------";
// show_array($_SESSION['cart']);


?>