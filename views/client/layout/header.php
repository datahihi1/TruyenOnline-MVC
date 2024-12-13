<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manga Reader</title>

    <!-- css files -->
    <link rel="stylesheet" href="<?= BASE_ASSETS ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="<?= BASE_ASSETS ?>css/main.css">
    <link rel="stylesheet" href="<?= BASE_ASSETS ?>css/bootstrap-icons.css">
    <style>
        .circle-img-x {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow py-2 py-sm-0">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <h5>TruyenOnline</h5>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container-fluid">
                <div class="row py-3">
                    <div class="col-lg-6 col-sm-12 mb-3 mb-sm-0">
                        <ul class="navbar-nav mr-auto">
                            <!-- always use single word for li -->
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Populer</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Browse
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach($listGenres as $list):?>
                                        <a class="dropdown-item" href="<?=BASE_URL . '?act=comic-genre&genre_id='.$list['genre_id']?>">
                                            <?=$list['name']?></a>
                                    <?php endforeach;?>
                                
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <form class="form-inline search">
                            <div class="input-group">
                                <form action="<?= BASE_URL . '?act=comic-search' ?>" method="post">
                                    <div class="input-group">
                                        <input type="text"
                                            name="searchComic"
                                            class="form-control"
                                            placeholder="Type Title, Author, or Genre"
                                            aria-label="Search for comics">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile float-right">
            <div class="saved">
                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-bookmark fa-2x"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php if (isset($_SESSION['user_login_id'])) : ?>
                        <a class="dropdown-item" href="#">
                            <div class="row">
                                <div class="col"><img src="<?= BASE_ASSETS_UPLOADS ?>img/cover1.jpg" width="50"></div>
                                <div class="col">
                                    <h5>One piece 1</h5>
                                    <small>Lastest <span>VOL. 11</span></small>
                                </div>
                            </div>
                        </a>
                        <hr>
                        <a class="dropdown-item" href="#">View all saved mangas (14)</a>
                    <?php else: ?>
                        <p>Chức năng này yêu cầu đăng nhập</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="account">
                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <?php if (isset($_SESSION['user_login_id'])): ?>
                        <img class="circle-img-x" src="<?= AVATAR_UPLOAD . $_SESSION['avatar'] ?>" alt="">
                        <i class="fa fa-angle-down"></i>
                    <?php else: ?>
                        <i class="fa fa-user-circle fa-2x"></i>
                        <i class="fa fa-angle-down"></i>
                    <?php endif; ?>
                </button>

                <?php if (isset($_SESSION['user_login_id'])): ?>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item">Hello, <?= $_SESSION['name'] ?></a>
                        <a class="dropdown-item">Have <?= $_SESSION['coin'] ?? '0' ?> coin</a>
                        <a class="dropdown-item" href="<?= BASE_URL . '?act=profile' ?>">Account Profile</a>
                        <?php if ($_SESSION['role'] == 1): ?>
                            <a class="dropdown-item" href="<?= BASE_URL . '?url=admin' ?>">Go to Admin dasboard</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?= BASE_URL . '?act=logout' ?>">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?= BASE_URL . '?act=login' ?>">Login</a>
                        <a class="dropdown-item" href="<?= BASE_URL . '?act=sign-up' ?>">Register</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- end navbar-->