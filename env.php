<?php

// $base_url = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
// define('BASE_URL', $base_url);

$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/TruyenOnline-MVC/"; // Example : http://192.168.1.1/TruyenOnline-MVC/
define('BASE_URL', $base_url);

// const BASE_URL = 'http://localhost/TruyenOnline-MVC/';
const BASE_URL_ADMIN = BASE_URL . '?url=admin';

const PATH_ROOT = __DIR__ .'/';

const PATH_VIEW_ADMIN = PATH_ROOT . 'views/admin/';
const PATH_VIEW_CLIENT = PATH_ROOT . 'views/client/';

const PATH_COMIC_UPLOAD = PATH_ROOT . 'assets/uploads/comics/';

const BASE_ASSETS = BASE_URL . 'assets/';

const BASE_ASSETS_UPLOADS =    BASE_URL . 'assets/uploads/';
const AVATAR_UPLOAD = BASE_ASSETS_UPLOADS . 'avatar/';
const COMIC_UPLOAD = BASE_ASSETS_UPLOADS . 'comics/';

const BASE_PAYMENT = BASE_URL . 'payment/';
const ZALO_PAYMENT = BASE_PAYMENT . '2_zalopay/';

const PATH_CONTROLLER_ADMIN =      PATH_ROOT . 'controllers/admin/';
const PATH_CONTROLLER_CLIENT =     PATH_ROOT . 'controllers/client/';

const PATH_MODEL = PATH_ROOT . 'models/';

const DB_HOST = 'localhost';
const DB_PORT = '3306';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'truyenonline';
const DB_OPTIONS =  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
