<?php
$user = new User();
$user->LoginProcess();


?>

<link rel="stylesheet" href="<?php if (isset($data['i'])) echo '../' ?>../public/css/user.css">
<div class="container-fluid">
    <section class="vh-100" style="background-color: #fff">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border: none; ">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center" style="display: <?php echo isset($data['i']) ? 'block' : 'none' ?>; color: red;">Bạn vui lòng đăng nhập để có thể thanh toán!!!</p>
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                        Đăng nhập
                                    </p>

                                    <form method="POST" class="mx-1 mx-md-4">
                                        <?php echo $user->form_error('account'); ?>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label class="form-label" for="form3Example3c"><i class="icon-register fa fa-envelope" aria-hidden="true"></i></label>

                                            <div class="form-outline flex-fill mb-0 contain-input">
                                                <input type="email" id="form3Example3c" name="email" class="form-control " placeholder="Email của bạn" value="<?php if (isset($_COOKIE['email'])) echo $_COOKIE['email'];
                                                                                                                                                                else if (isset($_POST['login-btn'])) echo $_POST['email'] ?>" />
                                            </div>
                                        </div>
                                        <?php echo $user->form_error('email'); ?>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label class="form-label" for="form3Example4c"><i class="icon-register fa fa-key" aria-hidden="true"></i></label>

                                            <div class="form-outline flex-fill mb-0 contain-input">
                                                <input type="password" name="password" id="form3Example4c" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" class="form-control" placeholder="Vui lòng nhập mật khẩu" />
                                            </div>
                                        </div>
                                        <?php echo $user->form_error('password'); ?>

                                        <div class="d-flex flex-row align-items-center" style="margin-left: 14%;">
                                            <input name="remember_me" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" <?php if (isset($_COOKIE['remember_me'])) echo "checked" ?>>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Ghi nhớ đăng nhập
                                            </label>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2" style="margin-left: 8%;">
                                            <label class="form-label" for="form3Example4cd">
                                                Bạn chưa có tài khoản? |
                                                <a href="/fast-food/User/Register">Đăng ký</a></label>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="login-btn" value="login-btn" style="background-color: #49491b" class="btn btn-primary btn-lg">
                                                Đăng nhập
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="<?php if (isset($data['i'])) echo '../' ?>../public/img/user/draw1.webp" class="img-fluid" alt="Sample image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>