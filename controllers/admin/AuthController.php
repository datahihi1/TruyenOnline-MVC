<?php

class AuthController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function loginForm()
    {
        require_once PATH_VIEW_ADMIN . 'login.php';
    }
    public function login()
    {
        $user_login = $_POST['username'] ?? null;
        $pass_login = $_POST['password'] ?? null;

        if (empty($user_login) || empty($pass_login)) {
            $_SESSION['app_err'] = 'Tên hoặc mật khẩu không được để trống';
            header('Location: ' . BASE_URL_ADMIN . '&act=login-form');
            exit();
        }

        $user = $this->user->checkLogin($user_login);

        if (empty($user)) {
            $_SESSION['app_err'] = 'Tài khoản không tồn tại';
            header('Location: ' . BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        if($user['role'] != 1){
            $_SESSION['app_err'] = 'Tài khoản người dùng không thể vào khu vực này';
            header('Location: ' . BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $verify = password_verify($pass_login,$user['password']);
        if(!$verify){
            $_SESSION['app_err'] = 'Sai mật khẩu';
            header('Location: ' . BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $_SESSION['user_login_id'] = $user['user_id'];
        $_SESSION['admin_user'] = $user['username'];
        $_SESSION['admin_avatar'] = $user['avatar'];
        header('Location: ' . BASE_URL_ADMIN);
        exit();
    }
    public function logout()
    {
        unset($_SESSION['admin_user'], $_SESSION['admin_avatar']);
        header('Location:' . BASE_URL);
        exit();
    }
}
