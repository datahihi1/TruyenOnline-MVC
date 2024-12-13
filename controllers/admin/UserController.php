<?php

class UserController{
    private $user;

    public function __construct()
    {
        if(empty($_SESSION['admin_user'])){
            header('Location:'.BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $this->user = new User();
    }
    // Hiển thị danh sách
    public function index()
    {
        $users = $this->user->getAll();

        require_once PATH_VIEW_ADMIN . 'users/index.php';
    }

    // Hiển thị chi tiết theo ID
    public function show()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['app_err'] = 'Yêu cầu không hợp lệ !';
            header('Location:'.BASE_URL_ADMIN . '&act=users-list');
            exit();
        }
        $id = $_GET['id'];

        $user = $this->user->getById($id);

        if (empty($user)) {
            $_SESSION['app_err'] = 'Không tồn tại';
            header('Location:'.BASE_URL_ADMIN . '&act=users-list');
            exit();
        } else {
            print_r($user);
            require_once PATH_VIEW_ADMIN . 'users/show.php';
        }
    }
    public function delete()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['app_err'] = 'Yêu cầu không hợp lệ !';
            header('Location:'.BASE_URL_ADMIN . '&act=users-list');
            exit();
        }
        $id = $_GET['id'];

        $user = $this->user->delById($id);

        if ($user) {
            $_SESSION['app_success'] = 'Xoá thành công';
            header('Location:'.BASE_URL_ADMIN . '&act=users-list');
            exit();
        } else {
            $_SESSION['app_err'] = 'Không tồn tại';
            header('Location:'.BASE_URL_ADMIN . '&act=users-list');
            exit();
        }
    }

}