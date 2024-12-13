<?php

require_once 'controllers/client/HomeController.php';
require_once 'controllers/client/UserController.php';

$act = $_GET['act'] ?? '/';


match ($act){
    '/' => (new HomeController)->index(),
    'comic-detail'=> (new HomeController)->comicDetail(),
    'comic-read'=> (new HomeController)->comicRead(),
    'comic-genre'=> (new HomeController)->comicGenre(),
    'comic-buy' =>(new HomeController)->comicBuy(),

    'comment'=>(new HomeController)->comment(),

    'login'=> (new UserController)->login(),
    'login-post'=> (new UserController)->loginPost(),
    'sign-up'=> (new UserController)->signUp(),
    'sign-up-post'=> (new UserController)->signUpPost(),
    'logout' => (new UserController)->logout(),

    'forgot-pass'=>(new UserController)->forgotPass(),
    'forgot-pass-post'=>(new UserController)->forgotPassPost(),
    'change-pass'=>(new UserController)->changePass(),
    'change-pass-post'=>(new UserController)->changePassPost(),

    
    default => e404(),
};

function e404(){
    http_response_code(404);
    echo '404 Not Found';
    exit;
}