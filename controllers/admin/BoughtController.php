<?php
class BoughtController{
    private $comic_bought;
    public function __construct(){
        if(empty($_SESSION['admin_user'])){
            header('Location:'.BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $this->comic_bought = new ComicBought();
    }
    public function index(){
        $bought = $this->comic_bought->getAll();
        // dd($bought);
        require_once PATH_VIEW_ADMIN .'boughts/index.php';
        exit();
    }
}