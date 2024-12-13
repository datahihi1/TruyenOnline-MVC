<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<style>
    .test-comic {
        max-width: 200px;
        max-height: 300;
    }
</style>

<h1 class="mt-4">Danh sách truyện</h1>
<a type="button" class="btn btn-success" href="<?= BASE_URL_ADMIN . '&act=comics-create' ?>">
    <i class="bi bi-plus-circle"></i> Thêm truyện mới
</a>
<div class="row">
    <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">

        <?php foreach ($comic as $c): ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <div class="bg-white card mb-4 order-list shadow-sm">
                        <div class="gold-members p-4">
                            <a href="<?=BASE_URL_ADMIN.'&act=comics-detail&comic_id='.$c['comic_id']?>">
                            </a>
                            <div class="media">
                                <a href="<?=BASE_URL_ADMIN.'&act=comics-detail&comic_id='.$c['comic_id']?>">
                                    <img class="mr-4 test-comic" src="<?= COMIC_UPLOAD . $c['title_img'] ?>" alt="Generic placeholder image">
                                </a>
                                <div class="media-body">
                                    <h6 class="mb-2">
                                        
                                        <a href="<?=BASE_URL_ADMIN.'&act=comics-detail&comic_id='.$c['comic_id']?>" class="text-black"><?= $c['comic_name'] ?></a>
                                    </h6>
                                    <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> Artist: <?= $c['artist'] ?>
                                    </p>
                                    <p class="text-gray mb-3"><i class="icofont-list"></i> Status: <?= $c['status'] ? 'Completed' : 'Updating' ?></p>
                                    <p class="text-dark"><?= $short_description = mb_substr($c['description'], 0, 90) . '...'; ?>
                                    </p>
                                    <hr>
                                    <div class="float-right">
                                        <a class="btn btn-sm btn-primary" href="<?=BASE_URL_ADMIN.'&act=chapters-list&comic_id='.$c['comic_id']?>">List Chapters</a>
                                        <div class="btn btn-sm dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Other action
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="#">Change price</a></li>
                                                <li><a class="dropdown-item" href="#">Update Status to <?= $c['status'] ? 'Updating' : 'Completed' ?></a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Coin Paid:</span>
                                        <?= isset($c['coin_price']) && $c['coin_price'] > 0 ? $c['coin_price'] : 'Free' ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div>

<?php include_once PATH_VIEW_ADMIN . 'layout/footer.php'; ?>