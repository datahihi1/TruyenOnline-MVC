<?php

class GenreController{
    private $genre;
    public function __construct(){
        if(empty($_SESSION['admin_user'])){
            header('Location:'.BASE_URL_ADMIN . '&act=login-form');
            exit();
        }
        $this->genre = new Genres();
    }
    public function index(){
        $genres = $this->genre->getAll();
        require_once PATH_VIEW_ADMIN . 'genres/index.php';
    }
    public function create(){
        require_once PATH_VIEW_ADMIN . 'genres/create.php';
    }
    public function store(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-create');
            exit();
        }
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        if(empty($genre)){
            $_SESSION['app_err'] = "Yêu cầu tên thể loại";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-create');
            exit();
        }
        $genres = $this->genre->getByName($genre);
        if($genres){
            $_SESSION['app_err'] = "Đã có thể loại";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-create');
            exit();
        }
        $this->genre->store($genre,$description);
        header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
        exit();
    }
    public function edit(){
        if(!isset($_GET['genre_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
            exit();
        }
        $id = $_GET['genre_id'];
        $genres = $this->genre->getById($id);
        if(!$genres){
            $_SESSION['app_err'] = "Không tìm thấy thể loại";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
            exit();
        }
        require_once PATH_VIEW_ADMIN . 'genres/edit.php';
    }
    public function update(){
        
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-edit');
            exit();
        }
        $id = $_POST['genre_id'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        if(empty($genre)){
            $_SESSION['app_err'] = "Yêu cầu tên thể loại";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-edit');
            exit();
        }

        $this->genre->update($genre,$description, $id);
        header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
        exit();
    }
    public function delete(){
        if(!isset($_GET['genre_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
            exit();
        }
        $id = $_GET['genre_id'];
        $check = $this->genre->checkGenresByGenreId($id);
        if($check){
            $_SESSION['app_err'] = "Xoá không thành công do thể loại đang được liên kết với truyện";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
            exit();
        }
        
        $this->genre->delete($id);
        header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
        exit();
    }
    public function listComic(){
        if(!isset($_GET['genre_id'])){
            $_SESSION['app_err'] = "Yêu cầu không hợp lệ";
            header('Location:'.BASE_URL_ADMIN . '&act=genres-list');
            exit();
        }
        $id = $_GET['genre_id'];

        $comics = $this->genre->getComicByGenreId($id);

        // dd($comics);
        
        require_once PATH_VIEW_ADMIN . 'genres/listComic.php';
        exit();
    }
}