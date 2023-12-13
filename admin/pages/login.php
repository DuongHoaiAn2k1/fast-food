<?php
global $error;
// show_array($_SESSION)
?>

<?php
$error = array();

if (isset($_POST['btn-submit'])) {
    if (empty($_POST['username'])) {
        $error['username'] = "Tên đăng nhập không được để trống!";
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $error['password'] = "Mật khẩu không được để trống!";
    } else {
        $password = md5($_POST['password']);
    }

    if (empty($error)) {
        if (check_admin_login($username, $password)) {
            $_SESSION['is_admin_login'] = true;
            $_SESSION['is_admin_login'] = true;
            $_SESSION['admin_login'] = $username;
            echo '<script>alert("Đăng nhập thành công");setTimeout(function(){window.location.href="?";}, 500);</script>';
        } else {
            $error['account'] = "Tài khoản hoặc mật khẩu không chính xác!";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Centered</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
    <style>
        html,
        body {
            background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }


        /* Tùy chỉnh chiều rộng của biểu mẫu */
        .custom-width {
            max-width: 400px;
            /* Điều chỉnh giới hạn chiều rộng tại đây */
            margin: 0 auto;
            /* Căn giữa biểu mẫu theo chiều ngang */
        }

        .error {
            color: red;
            margin-top: -22px;
        }
    </style>
</head>

<?php


?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-6 custom-width">
                <div class="card">
                    <div class="card-header">
                        <form method="POST">
                            <h2 class="text-center" style="margin-bottom: 20px;">Đăng nhập</h2>
                            <?php echo form_error('account') ?>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="form1Example1" class="form-control" name="username" />
                                <label class="form-label" for="form1Example1">UserName</label>
                            </div>
                            <?php echo form_error('username') ?>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="form1Example2" class="form-control" name="password" />
                                <label class="form-label" for="form1Example2">Password</label>
                            </div>
                            <?php echo form_error('password') ?>
                            <!-- Submit button -->
                            <button type="submit" name="btn-submit" value="btn-submit" class="btn btn-primary btn-block">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
</body>

</html>