<?php
$cart = new Cart();

?>

<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }

    .bg-grey {
        background-color: #eae8e8;
    }

    @media (min-width: 992px) {
        .card-registration-2 .bg-grey {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }

    @media (max-width: 991px) {
        .card-registration-2 .bg-grey {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }
</style>

<div id="head-main-page-2" class="container-fluid mt-5">
    <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">

                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">GIỎ HÀNG CỦA BẠN</h1>
                                            <h6 id="total-order" class="mb-0 text-muted"><?php echo isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info']['total_order'] : 0 ?> sản phẩm</h6>
                                        </div>
                                        <hr class="my-4">
                                        <?php
                                        if (isset($_SESSION['cart']['buy'])) {
                                            foreach ($_SESSION['cart']['buy'] as $item) {
                                        ?>


                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="admin/<?php echo $item['img'] ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted"><?php echo $item['product_name'] ?></h6>
                                                        <h6 class="text-black mb-0"><?php echo currency_format($item['price']) ?></h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input id="form1" name="
                                                        " value="<?php echo $item['qty'] ?>" type="number" class="form-control form-control-sm quantity" style="width: 40px" min="1" max="9" value="1" data-id="<?php echo $item['product_id'] ?>" />
                                                        <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h6 id="sub-total-<?php echo $item['product_id']; ?>" class="mb-0"><?php echo currency_format($item['sub_total']) ?></h6>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a id="delete_cart" href="/fast-food/Cart/deleteCart/<?php echo $item['product_id'] ?>" class="text-muted delete_cart"><i class="fas fa-times"></i></a>
                                                    </div>
                                                </div>

                                                <hr class="my-4">



                                        <?php
                                            }
                                        } else {
                                            echo "<h2>Giỏ hàng của bạn trống</h2>";
                                        }
                                        ?>
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="/fast-food/Product/" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua hàng</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Thông tin giỏ hàng</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 id="total-order-bill" class="text-uppercase"><?php echo isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info']['total_order'] : 0 ?> sản phẩm</h5>
                                        </div>

                                        <h5 class="text-uppercase mb-3">Hình thức thanh toán</h5>

                                        <div class="mb-4 pb-2">
                                            <select class="select">
                                                <option value="1">Thanh toán khi nhận hàng</option>

                                            </select>
                                        </div>



                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Tổng tiền</h5>
                                            <h5 id="total-money"><?php echo currency_format(isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info']['total_money'] : 0) ?></h5>
                                        </div>

                                        <a href="<?php echo isset($_SESSION['is_login']) ? '/fast-food/Cart/bill' : '/fast-food/User/LoginToPay/1' ?>" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">THANH TOÁN</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}
// show_array($_COOKIE);
// show_array($category);
// require "./inc/footer.php";

?>