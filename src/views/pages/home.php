<?php
// $category = get_list_category();
// $list_product = get_list_product();

// require "inc/header.php";

// print_r($data['categories']);
?>

<style>
    .img-menu {
        height: 100%;
        width: 100%;
    }

    div [class^="col-"] {
        padding-left: 5px;
        padding-right: 5px;
    }

    .card {
        transition: 0.5s;
        cursor: pointer;
    }

    .card-title {
        font-size: 16px;
        transition: 1s;
        cursor: pointer;
        padding-left: 5%;
        font-weight: 600;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
    }

    .card-title i {
        font-size: 15px;
        transition: 1s;
        cursor: pointer;
        color: #ffa710
    }

    .card-title i:hover {
        transform: scale(1.25) rotate(100deg);
        color: #18d4ca;

    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
    }

    .card-text {
        height: 80px;
    }

    .card::before,
    .card::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: scale3d(0, 0, 1);
        transition: transform .3s ease-out 0s;
        background: rgba(255, 255, 255, 0.1);
        content: '';
        pointer-events: none;
    }

    .card::before {
        transform-origin: left top;
    }

    .card::after {
        transform-origin: right bottom;
    }

    .card:hover::before,
    .card:hover::after,
    .card:focus::before,
    .card:focus::after {
        transform: scale3d(1, 1, 1);
    }

    h1 {
        position: relative;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    h1::after {
        content: "";
        display: block;
        width: 50%;
        /* Độ rộng của đường kẻ, bạn có thể điều chỉnh theo mong muốn */
        height: 1px;
        /* Độ dày của đường kẻ, bạn có thể điều chỉnh theo mong muốn */
        background-color: black;
        /* Màu của đường kẻ */
        position: absolute;
        bottom: 0;
        left: 25%;
        /* Vị trí ngang của đường kẻ, điều chỉnh để đặt giữa */
    }
</style>



<div id="head-main-page" class="container-fluid mt-5">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/img/main-background/back_ground_1.jpg" class="d-block w-100 img-custom" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="public/img/main-background/back_ground_2.jpg" class="d-block w-100 img-custom" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="public/img/main-background/back_ground_3.jpg" class="d-block w-100 img-custom" alt="..." />
            </div>
        </div>
    </div>
</div>

<div class="container mt-2">

    <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">DANH MỤC MÓN ĂN</h1>
    <div class="row">
        <?php foreach ($data['categories'] as $item) {
        ?>
            <div class="col-md-3 col-sm-6 mt-3">
                <a href="/fast-food/Product/List/<?php echo $item['category_id'] ?>" style="text-decoration: none;">
                    <div class="card card-block">
                        <img class="img-menu" src="admin/<?php echo $item['img_cat'] ?>" alt="Photo of sunset">
                        <h4 class="card-title mt-3 mb-3" style="text-decoration: none; color:black"><?php echo $item['category_name'] ?> ></h4>
                    </div>
                </a>
            </div>
        <?php
        } ?>
    </div>

</div>

<div class="container mt-2">

    <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">CÓ THỂ BẠN SẼ THÍCH NHỮNG MÓN NÀY</h1>
    <div class="row">
        <?php for ($i = 0; $i <= 3; $i++) {
        ?>
            <div class="col-md-3 col-sm-6 mt-3">
                <div class="card card-block">
                    <img class="img-menu" src="admin/<?php echo $data['products'][$i]['img'] ?>" alt="Photo of sunset">
                    <h4 class="card-title mt-3 mb-3 d-flex justify-content-between"><?php echo $data['products'][$i]['product_name'] ?> <span class="contain-price"><?php echo currency_format($data['products'][$i]['price']) ?></span>
                    </h4>
                    <a id="" href="?mod=cart&act=cart&product_id=<?php echo $data['products'][$i]['product_id'] ?>" name="add-cart" type="button" class="btn btn-danger btn-rounded <?php if ($data['products'][$i]['sold_out']) echo 'unclickable'; ?>" style="background-color: #a23232;"><span class="add-cart"><?php if ($data['products'][$i]['sold_out']) echo 'Hết hàng';
                                                                                                                                                                                                                                                                                                                    else echo 'Thêm' ?></span></a>
                </div>
            </div>
        <?php
        } ?>
    </div>

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