<!-- Footer -->
<?php
require_once "./src/models/ProductModel.php";
?>
<footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->

        <!-- Section: Form -->

        <!-- Section: Form -->

        <!-- Section: Text -->
        <section class="mb-4">
            <p>
                Tận hưởng hương vị vượt thời gian tại cửa hàng thức ăn nhanh của chúng tôi.
            </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 contain-footer">
                    <h5 style="text-align: left;" class="text-uppercase">Danh mục món ăn</h5>

                    <ul style="text-align: left;" class="list-unstyled mb-0 ">
                        <?php
                        $product = new ProductModel();
                        $category = $product->getCategories();
                        foreach ($category as $item) {
                        ?>
                            <li style="text-align: left;">
                                <a href="?mod=product&category_id=<?php echo $item['category_id'] ?>" style=" color: #ABABAB !important; " href="#!" class="text-white"><?php echo $item['category_name'] ?></a>
                            </li>
                        <?php
                        }

                        ?>

                        <!-- <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">COMBO NHÓM</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">GÀ GÁN - GÀ QUAY</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">BURGER - CƠM - MỲ Ý</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">THỨC UỐNG & TRÁN MIỆNG</a>
                        </li> -->
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 style="text-align: left;" class="text-uppercase">Châm ngôn</h5>

                    <ul style="text-align: left;" class="list-unstyled mb-0 ">
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Khám phá hương vị nhanh chóng!</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Thỏa lòng bất cứ lúc nào, bất cứ nơi đâu.</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Chất lượng đỉnh cao, thời gian phục vụ nhanh chóng.</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Mang hạnh phúc vào từng miếng thức ăn.</a>
                        </li>
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Tạo nên hương vị đặc biệt mỗi ngày.</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 style="text-align: left;" class="text-uppercase">Liên hệ</h5>

                    <ul style="text-align: left;" class="list-unstyled mb-0 ">
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Liên hệ cửa hàng</a>
                        </li>

                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 style="text-align: left;" class="text-uppercase">Lời cảm ơn</h5>

                    <ul style="text-align: left;" class="list-unstyled mb-0 ">
                        <li style="text-align: left;">
                            <a style="text-decoration: none; color: #ABABAB !important; " href="#!" class="text-white">Cảm ơn các bạn đã tin tưởng và lựa chọn sản phẩm của cửa hàng!</a>
                        </li>

                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Tác giả:
        <span>Dương Hoài Ân - B2014552</span>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
<script>
    const menuButton = document.getElementById("menu-button");
    const closeButton = document.getElementById("close-button");
    const sidebar = document.getElementById("sidebar");

    menuButton.addEventListener("click", () => {
        sidebar.style.width = "250px";
    });

    closeButton.addEventListener("click", () => {
        sidebar.style.width = "0";
    });
</script>
<!-- MDB -->
<script src="public/js/cart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>