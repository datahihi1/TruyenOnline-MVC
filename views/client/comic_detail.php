<?php include_once PATH_VIEW_CLIENT . 'layout/header.php'; ?>
<div class="container my-5">
    <div class="read-intro bg-light">
        <i class="far fa-bookmark fa-3x"></i>
        <div class="row">
            <div class="cover col-*">
                <img class="shadow" src="<?= COMIC_UPLOAD . $comics['title_img'] ?>" alt="">
            </div>
            <div class="info col">
                <h2 class="head"><?= $comics['comic_name'] ?></h2>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">Genre:</th>
                            <td><?= $genres['genres'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Artist:</th>
                            <td><?= $comics['artist'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Update:</th>
                            <td>Chapter. <?= $comics['chap_total'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">View:</th>
                            <td><?= $comics['view_count'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Coin price:</th>
                            <td><?= isset($comics['coin_price']) && $comics['coin_price'] > 0 ? $comics['coin_price'] : 'Miễn phí' ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    <?= $comics['description'] ?>
                </p>
            </div>
        </div>
        <div class="row">
            <?php if (isset($needCoin)): ?>
                <?php if ($needCoin == 0): ?>
                    <!-- Nếu truyện 0 coin, cho phép đọc miễn phí -->
                    <a class="btn btn-red my-3 mx-1 px-5" href="<?= BASE_URL . '?act=comic-read&comic_id=' . $comics['comic_id'] . '&chapter_id=1' ?>">
                        Start Reading
                    </a>
                <?php else: ?>
                    <!-- Nếu cần coin, kiểm tra đăng nhập -->
                    <?php if (isset($_SESSION['user_login_id'])): ?>
                        <a class="btn btn-red my-3 mx-1 px-5" href="<?= BASE_URL . '?act=comic-buy&comic_id=' . $comics['comic_id'] . '&user_id=' . $_SESSION['user_login_id'] ?>">
                            Buy With <?= $needCoin ?> coin
                        </a>
                    <?php else: ?>
                        <a class="btn btn-red my-3 mx-1 px-5" href="<?= BASE_URL . '?act=login' ?>">
                            Require Login
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- end reading intro -->

<!-- start intro lists -->
<div class="container my-5 bg-white">
    <div class="intro-lists">
        <div class="head-list row bg-light">
            <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><a data-toggle="tab" class="active" href="javascript:void(0);">Chapter</a></li>
            </ul>
        </div>
        <div class="tab-content">

            <!-- start ch -->
            <div id="ch" class="tab-pane fade in active show">
                <div class="row">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach ($chap as $c): ?>
                                <tr>
                                    <th><a href="<?= BASE_URL . '?act=comic-read&comic_id=' . $c['comic_id'] . '&chapter_id=' . $c['chap_number'] ?>">CH. <?= $c['chap_number'] ?> - <?= $c['title'] ?? 'Không có mô tả' ?></a></th>
                                    <td class="text-muted text-uppercase float-right"><?= $c['view_count'] ?><i class="bi bi-eye"></i></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end ch -->

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Bình luận -->
        <div class="anime__details__review">
            <div class="section-title">
                <h5>Bình luận</h5>
            </div>
            <div class="anime__review__item">
                <?php foreach ($comment as $cm) { ?>
                    <div class="media mb-3">
                        <img class="mr-3" src="<?php echo AVATAR_UPLOAD. $cm['avatar']; ?>" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                        <div class="media-body">
                            <h6 class="mt-0"><?php echo $cm['username']; ?> - <span><?php echo $cm['created_at']; ?></span></h6>
                            <p><?php echo $cm['content']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <!-- Form bình luận -->
        <div class="anime__details__form">
            <div class="section-title">
                <h5>Your Comment</h5>
            </div>
            <form action="index.php?act=comment&comic_id=<?=$comics['comic_id']?>&user_id=<?php if(isset($_SESSION['user_login_id'])){echo $_SESSION['user_login_id'];}?>" method="POST">
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="4" placeholder="Enter your comment"></textarea>
                </div>
                <button name="comment" type="submit" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Review</button>
            </form>
        </div>
    </div>
</div>


<!-- end sh. list -->
<?php include_once PATH_VIEW_CLIENT . 'layout/footer.php'; ?>


