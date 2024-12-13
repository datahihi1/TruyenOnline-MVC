<?php

class AdminController{
    public function __construct(){
        if(empty($_SESSION['admin_user'])){
            header('Location:'.BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
    }
    public function dashboard(){
        require_once PATH_VIEW_ADMIN . 'dashboard.php';
    }
}