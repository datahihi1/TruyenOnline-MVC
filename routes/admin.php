<?php

require_once 'controllers/admin/AdminController.php';
require_once 'controllers/admin/UserController.php';
require_once 'controllers/admin/AuthController.php';
require_once 'controllers/admin/GenreController.php';

$act = $_GET['act'] ?? '/';


match($act){
    '/' => (new AdminController)->dashboard(),
    'login-form' => (new AuthController)->loginForm(),
    'login' => (new AuthController)->login(),
    'logout'=> (new AuthController)->logout(),

    // Quản lý Người dùng
    'users-list'    => (new UserController)->index(),
    'users-show'     => (new UserController)->show(),
    'users-delete'   => (new UserController)->delete(),
    // 'users-create'   => (new UserController)->create(),
    // 'users-store'    => (new UserController)->store(),
    // 'users-edit'     => (new UserController)->edit(),
    // 'users-update'   => (new UserController)->update(),

    // Quản lý Thể loại
    'genres-list' => (new GenreController)->index(),
    'genres-create' => (new GenreController)->create(),
    'genres-store' => (new GenreController)->store(),
    'genres-edit' => (new GenreController)->edit(),
    'genres-update' => (new GenreController)->update(),
    'genres-delete' => (new GenreController)->delete(),
    'genres-comic' => (new GenreController)->listComic(),

    //Quản lý Truyện
    'comics-list' => (new ComicController)->index(),
    'comics-create' => (new ComicController)->create(),
    'comics-store' => (new ComicController)->store(),
    'comics-detail' => (new ComicController)->comicDetail(),

    //Quản lý Chương truyện
    'chapters-list' => (new ComicController)->listChapter(),
    'chapters-create' => (new ComicController)->createChapter(),
    'chapters-store' => (new ComicController)->chapterStore(),

    //Quản lý Mua truyện
    'boughts-list' => (new BoughtController)->index(),
    
    default => e404(),
};

function e404(){
    http_response_code(404);
    include_once PATH_VIEW_ADMIN.'layout/header.php';
    echo '404 Not Found';
    include_once PATH_VIEW_ADMIN.'layout/footer.php';
    exit;
}