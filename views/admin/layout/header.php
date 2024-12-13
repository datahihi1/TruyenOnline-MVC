<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Sidebar - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?=BASE_ASSETS?>css/styles.css" rel="stylesheet" />
        <link href="<?=BASE_ASSETS?>css/bootstrap-icons.css" rel="stylesheet">
        <style>
              .circle-img {
                width: 40px;
                height: 40px; 
                border-radius: 50%; 
                object-fit: cover; 
            }
        </style>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><a style="text-decoration: none; color: inherit;" href="<?=BASE_URL?>">TruyenOnline</a></div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=BASE_URL_ADMIN?>">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=BASE_URL_ADMIN?>&act=comics-list">Quản lý truyện</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=BASE_URL_ADMIN?>&act=genres-list">Quản lý thể loại</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=BASE_URL_ADMIN?>&act=users-list">Quản lý người dùng</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?=BASE_URL_ADMIN?>&act=boughts-list">Quản lý giao dịch mua truyện</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Quản lý giao dịch nạp tiền</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Thống kê</a>
                    <div class="d-flex flex-column flex-shrink-0 p-3">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?=AVATAR_UPLOAD . $_SESSION['admin_avatar']?>" alt="" width="40" height="40" class="rounded-circle me-3">
                                <strong style="color: black"><?=$_SESSION['admin_user']?></strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" >Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?=BASE_URL_ADMIN . '&act=logout'?>" >Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Page content-->
                <div class="container-fluid">
                <?php if(isset($_SESSION['app_err'])):?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['app_err']; unset($_SESSION['app_err']);?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif(isset($_SESSION['app_success'])):?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['app_success']; unset($_SESSION['app_success']);?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif;?>