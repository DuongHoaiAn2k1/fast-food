<?php

class User extends Controller
{
    function is_username($username)
    {
        // /^(?=.*[A-Za-z0-9_\.])(?=.*[\W_])[A-Za-z0-9_\.\W]{6,32}$/
        $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
        if (!preg_match($pattern, $username, $matchs))
            return false;
        return true;
    }
    function is_password($password)
    {
        $pattern = "/^(?=.*[A-Za-z]).{6,20}$/";
        if (!preg_match($pattern, $password, $matchs))
            return false;
        return true;
    }
    function form_error($label_field)
    {
        global $error;
        if (!empty($error[$label_field]))
            return "<p class='error'>{$error[$label_field]}!</p>";
    }


    function is_email($email)
    {
        $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (!preg_match($partten, $email, $matchs))
            return false;
        return true;
    }
    function Login()
    {
        $User = $this->view("main", [
            'Page' => 'login',

        ]);
    }
    function LoginToPay($i)
    {
        $User = $this->view("main", [
            'Page' => 'login',
            'i' => $i
        ]);
    }
    function LoginProcess()
    {
        $userModel = $this->model("UserModel");
        global $error, $email, $password;
        if (isset($_POST['login-btn'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống tên đăng nhập";
            } else {
                $email = $_POST['email'];
            }

            if (empty($_POST['password'])) {
                $error['password'] = "Không được để trống mật khẩu";
            } else {
                if (!$this->is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu phải có ít nhất một chữ cái và độ dài >=6 ký tự";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            if (empty($error)) {
                if ($userModel->check_login($email, $password)) {
                    $_SESSION['is_login'] =  true;
                    $_SESSION['user_login'] = $email;
                    $_SESSION['user_id'] = $userModel->get_id_user($email);
                    if (!empty($_POST['remember_me'])) {
                        setcookie('email', $email, time() + 36000);
                        setcookie('password', $_POST['password'], time() + 36000);
                        setcookie('remember_me', true, time() + 36000);
                    } else {
                        setcookie('email', $email, time() - 36000);
                        setcookie('password', $_POST['password'], time() - 36000);
                        setcookie('remember_me', true, time() - 36000);
                    }
                    echo '<script>alert("Đăng nhập thành công");setTimeout(function(){window.location.href="/fast-food";}, 500);</script>';
                } else {
                    $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
                }
            }
        }
    }

    function Register()
    {
        $User = $this->view("main", [
            "Page" => "register"
        ]);
    }

    function RegisterProcess()
    {
        $userModel = $this->model("UserModel");
        global $error, $password, $email, $fullname;
        if (isset($_POST['register-btn'])) {
            $error = array();
            if (empty($_POST['full_name'])) {
                $error['full_name'] = "Không được để trống họ tên";
            } else {
                $fullname = $_POST['full_name'];
            }

            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (!$this->is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            if (empty($_POST['password'])) {
                $error['password'] = "Không được để trống mật khẩu";
            } else {
                if (!$this->is_password($_POST['password'])) {
                    $error['password'] = "Mật khẩu phải có ít nhất một chữ cái và độ dài >=6 ký tự";
                } else {
                    $password = md5($_POST['password']);
                }
            }

            if (empty($_POST['confirm_password'])) {
                $error['confirm_password'] = "Mật khẩu nhập lại không được để trống";
            } else {
                if ($_POST['confirm_password'] != $_POST['password']) {
                    $error['confirm_password'] = "Mật khẩu nhập lại không khớp";
                } else {
                }
            }

            if (empty($_POST['phone'])) {
                $error['phone'] = "Không được để trống số điện thoại";
            } else {
                $phone = $_POST['phone'];
            }

            if (empty($_POST['address'])) {
                $error['address'] = "Không được để trống địa chỉ";
            } else {
                $address = $_POST['address'];
            }

            if (empty($error)) {
                if (!$userModel->user_exists($email)) {
                    $data = array(
                        'name' => $fullname,
                        'email' => $email,
                        'pass' => $password,
                        'phone' => $phone,
                        'address' => $address,
                        'time' => date("y/m/d h:m:s"),
                    );

                    $userModel->add_user($data);
                    echo '<script>alert("Đăng ký thành công!");setTimeout(function(){window.location.href="/fast-food/User/Login";}, 1000);</script>';
                    // echo "<script>alert('Đăng ký thành công')</script>";
                    // sleep(3);
                    // redirect("?mod=users&action=login");
                } else {
                    $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
                }
            } else {
                // show_array($error);
            }
        }
    }

    function logOutProcess()
    {
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
        unset($_SESSION['user_id']);
        redirect("/fast-food/login");
    }
    function Account()
    {
        $User = $this->view("main", [
            "Page" => "account"
        ]);
    }

    function update_account()
    {
        $userModel = $this->model("UserModel");
        $user = $userModel->get_user_by_id($_SESSION['user_id']);
        if (isset($_POST['update_account'])) {
            $error = array();
            if (empty($_POST['full_name'])) {
                $error['full_name'] = "Không được để trống họ tên";
            } else {
                $fullname = $_POST['full_name'];
            }


            if (empty($_POST['phone'])) {
                $error['phone'] = "Không được để trống số điện thoại";
            } else {
                $phone = $_POST['phone'];
            }

            if (empty($_POST['address'])) {
                $error['address'] = "Không được để trống địa chỉ";
            } else {
                $address = $_POST['address'];
            }
            if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                $upload_dir = 'admin/uploads/';
                $upload_file = $upload_dir . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
            } else {
                $upload_file = $user['user_img'];
            }
            if (empty($error)) {
                $data = array(
                    'user_id' => $_SESSION['user_id'],
                    'name' => $fullname,
                    'user_img' => $upload_file,
                    'phone' => $phone,
                    'address' => $address,
                );

                $userModel->update_user($data);
                echo '<script>alert("Cập nhật thành công!");setTimeout(function(){window.location.href="/fast-food/User/account";}, 1000);</script>';
                // echo "<script>alert('Đăng ký thành công')</script>";
                // sleep(3);
                // redirect("?mod=users&action=login");
            } else {
                // show_array($error);
            }
        }
    }

    function logOut()
    {
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
        unset($_SESSION['user_id']);
        $this->redirect("/fast-food/User/Login");
    }
}
