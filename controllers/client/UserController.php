<?php

class UserController
{
    public $user;
    public $genres;
    public function __construct()
    {
        $this->genres = new Genres();
        $this->user = new User();
    }
    public function login()
    {
        $listGenres = $this->genres->getAll();
        if (isset($_SESSION['user_login_id'])) {
            echo "
            <script>
                alert('Đã có tài khoản đăng nhập trên thiết bị!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        require_once PATH_VIEW_CLIENT . 'users/login.php';
    }
    public function loginPost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ.";
            header('Location:' . BASE_URL . '?act=login');
            exit();
        }
        $user_login = $_POST['username'] ?? null;
        $pass_login = $_POST['password'] ?? null;

        if (empty($user_login)) {
            $_SESSION['app_err'] = "Tên không được để trống.";
            require_once PATH_VIEW_CLIENT . 'users/login.php';
            exit();
        }
        if (empty($pass_login)) {
            $_SESSION['app_err'] = "Mật khẩu không được để trống.";
            require_once PATH_VIEW_CLIENT . 'users/login.php';
            exit();
        }
        $user = $this->user->checkLogin($user_login);
        if (empty($user)) {
            $_SESSION['app_err'] = "Không tìm thấy người dùng.";
            require_once PATH_VIEW_CLIENT . 'users/login.php';
            exit();
        }
        $verify = password_verify($pass_login,$user['password']);
        if (!$verify) {
            $_SESSION['app_err'] = "Sai mật khẩu.";
            require_once PATH_VIEW_CLIENT . 'users/login.php';
            exit();
        }
        $_SESSION['user_login_id'] = $user['user_id'];
        if ($user['role'] == 1) {
            $_SESSION['admin_user'] = $user['username'];
            $_SESSION['admin_avatar'] = $user['avatar'];
        }
        header('Location:' . BASE_URL);
        exit();
    }
    public function forgotPass(){
        $listGenres = $this->genres->getAll();
        if (isset($_SESSION['user_login_id'])) {
            echo "
            <script>
                alert('Đã có tài khoản đăng nhập trên thiết bị!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        require_once PATH_VIEW_CLIENT . 'users/forgot-pass.php';
    }
    public function forgotPassPost(){

    }
    public function changePass(){

    }
    public function changePassPost(){
        
    }
    public function signUp()
    {
        $listGenres = $this->genres->getAll();
        if (isset($_SESSION['user_login_id'])) {
            echo "
            <script>
                alert('Đã có tài khoản đăng nhập trên thiết bị!');
                window.location.href = '" . BASE_URL . "';
            </script>";
            exit();
        }
        require_once PATH_VIEW_CLIENT . 'users/signup.php';
    }
    public function signUpPost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ.";
            header('Location:' . BASE_URL . '?act=sign-up');
            exit();
        }
        $user_signup = $_POST['username'];
        $email_signup = $_POST['email'];
        $pass_signup = $_POST['password'];
        $avatar_signup = $_FILES['avatar'];

        if (empty($user_signup)) {
            $_SESSION['app_err'] = "Không để trống tên.";
            header('Location:' . BASE_URL . '?act=sign-up');
            exit();
        }
        if (empty($email_signup)) {
            $_SESSION['app_err'] = "Không để trống email.";
            header('Location:' . BASE_URL . '?act=sign-up');
            exit();
        }
        if (empty($pass_signup)) {
            $_SESSION['app_err'] = "Không để trống mật khẩu.";
            header('Location:' . BASE_URL . '?act=sign-up');
            exit();
        }
        $users = $this->user->checkSignup($user_signup);
        if (isset($users['username'])) {
            $_SESSION['app_err'] = "Tên người dùng đã được sử dụng.";
            header('Location:' . BASE_URL . '?act=sign-up');
            exit();
        }

        $hash = password_hash($pass_signup,PASSWORD_DEFAULT);

        $image_path = null;

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            if ($_FILES['avatar']['size'] > 10 * 1024 * 1024) {
                $_SESSION['app_err'] =  "Dung lượng ảnh vượt quá 10MB.";
                header('Location:' . BASE_URL . '?act=sign-up');
                exit();
            } else {
                $random_str = substr(bin2hex(random_bytes(10)), 0, 6);
                $file_extension = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
                $file_name = "{$user_signup}_{$random_str}.{$file_extension}";
                $target_file = PATH_ROOT . 'assets/uploads/avatar/' . $file_name;

                $allowed_types = ["jpg", "jpeg", "png", "gif"];
                if (in_array($file_extension, $allowed_types)) {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        $image_path = $target_file;
                    } else {
                        $_SESSION['app_err'] =  "Đã xảy ra lỗi khi tải lên hình ảnh.";
                        header('Location:' . BASE_URL . '?act=sign-up');
                        exit();
                    }
                } else {
                    $_SESSION['app_err'] =  "Chỉ chấp nhận các định dạng JPG, JPEG, PNG và GIF.";
                    header('Location:' . BASE_URL . '?act=sign-up');
                    exit();
                }
            }
        }

        $this->user->newUser($user_signup, $email_signup, $hash, $file_name);
        header('Location:' . BASE_URL . '?act=login');
        exit();
    }
    public function logout()
    {
        if (isset($_SESSION['user_login_id'])) {
            unset($_SESSION['user_login_id']);
            if (isset($_SESSION['admin_user'])) {
                unset($_SESSION['admin_user'], $_SESSION['admin_avatar']);
            }
            header('Location:' . BASE_URL);
            exit();
        }
    }
}
