<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #a23232;
    }

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

    .unclickable {
        cursor: not-allowed;
        pointer-events: none;
    }
</style>
<div id="head-main-page-product" class="container-fluid mt-5">
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-fill mb-3 border" id="ex1" role="tablist">

        <?php
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }
        $i = 0;
        foreach ($data['categories'] as $category) {
            $i++;
        ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php if ($i === 1) echo 'active' ?> " id="ex2-tab-<?php echo $i; ?>" data-mdb-toggle="pill" href="#ex2-pills-<?php echo $i; ?>" role="tab" aria-controls="ex2-pills-<?php echo $i; ?>" aria-selected="true" data-category-id="<?php echo $category['category_id']; ?>"><?php echo $category['category_name'] ?></a>
            </li>
        <?php
        }
        ?>
    </ul>
    <!-- Pills navs -->
    <?php
    ?>
    <!-- Pills content -->
    <div class="tab-content" id="ex2-content">

        <?php
        $i = 0;
        foreach ($data['categories'] as $category) {
            $i++;
        ?>
            <div class="tab-pane fade <?php if ($i === 1) echo 'show active' ?> " id="ex2-pills-<?php echo $i; ?>" role="tabpanel" aria-labelledby="ex2-tab-<?php echo $i; ?>">
                <div class="container mt-2">
                    <h2 style="font-family:'Times New Roman', Times, serif; text-transform: uppercase; font-weight: 600;"><?php echo $category['category_name'] ?></h2>
                    <div class="row">
                        <?php
                        $list_product = array_filter($data['products'], function ($product) use ($category) {
                            return $product['category_id'] == $category['category_id'];
                        });
                        // show_array($list_product);
                        foreach ($list_product as $item) {
                        ?>
                            <div class="col-md-3 col-sm-6 mt-3">
                                <div class="card card-block">
                                    <img class="img-menu" src="<?php if (isset($data['categoryID'])) echo '../' ?>../admin/<?php echo $item['img'] ?>" alt="Photo of sunset">
                                    <h4 class="card-title mt-3 mb-3 d-flex justify-content-between"><?php echo $item['product_name'] ?> <span class="contain-price"><?php echo currency_format($item['price']) ?></h4>
                                    <input type="text" style="display: none;" name="product_id" value="<?php echo $item['product_id'] ?>">
                                    <a id="" href="/fast-food/Cart/createCart/<?php echo $item['product_id'] ?>" name="add-cart" type="button" class="btn btn-danger btn-rounded <?php if ($item['sold_out']) echo 'unclickable'; ?>" style="background-color: #a23232;"><span class="add-cart"><?php if ($item['sold_out']) echo 'Hết hàng';
                                                                                                                                                                                                                                                                                                else echo 'Thêm' ?></span></a>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>

                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- Pills content -->
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var categoryID = <?php echo isset($data['categoryID']) ? $data['categoryID'] : ''; ?>;

        if (categoryID > 0) {
            // Tìm thẻ <a> có data-category-id tương ứng với categoryID và kích hoạt sự kiện click
            var linkElement = document.querySelector("[data-category-id='" + categoryID + "']");

            if (linkElement) {
                linkElement.click();
            }
        }
        document.querySelector(".unclickable").addEventListener("click", function(event) {
            event.preventDefault();
        });


    });
</script>

<?php
function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}
?>