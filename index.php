<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
// session_destroy();

require_once 'env.php';
require_once 'autoload.php';
include_once 'helper.php';

$url = $_GET['url'] ?? 'client';
switch ($url) {
    case 'ad':
    case 'admin':
        require_once 'routes/admin.php';
        break;
    default:
        require_once 'routes/client.php';
        break;
}
