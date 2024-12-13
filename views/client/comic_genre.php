<?php include_once PATH_VIEW_CLIENT . 'layout/header.php'; ?>

    <!-- start lastest -->
    <div class="lastest container mt-4 mt-sm-5">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="font-weight-bolder float-left">Lastest Manga Updates</h2>
            </div>
            <div class="col-lg-6">
                <ul class="calendar list-unstyled list-inline float-right font-weight-bold mt-3 mt-sm-0">
                    <li class="list-inline-item active">Today</li>
                    <li class="list-inline-item">Yesterday</li>
                    <li class="list-inline-item">Sun</li>
                    <li class="list-inline-item">Fri</li>
                    <li class="list-inline-item">Thur</li>
                    <li class="list-inline-item">Wed</li>
                </ul>
            </div>
        </div>

        <div class="posts row">
            <?php foreach($comic as $c):?>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="card mb-3">
                    <a href="<?=BASE_URL . '?act=comic-detail&comic_id='.$c['comic_id']?>"> <img src="<?=COMIC_UPLOAD . $c['title_img']?>" class="card-img-top" alt=""></a>
                    <div class="over text-center">
                        <div class="head text-left">
                            <h6><?=$c['comic_name']?></h6>
                        </div>
                        <div class="about-list">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row">Views:</th>
                                        <td><?=$c['view_count']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Artist:</th>
                                        <td><?=$c['artist']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Update:</th>
                                        <td>Chapter. <?=$c['chap_total']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="about text-muted">
                            <?php if(!empty($c['description'])):?>
                            <?=$short_description = mb_substr($c['description'], 0, 90) . '...';?>
                            <?php else:?>
                            <p>Truyện không có mô tả chi tiết</p>
                            <?php endif;?>
                        </p>
                        <a class="reading btn" href="<?=BASE_URL."?act=comic-read&comic_id=" . $c['comic_id']."&chapter_id=1"?>">Start reading VOL. 1</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?=BASE_URL . '?act=comic-detail&comic_id='.$c['comic_id']?>"><?=$c['comic_name']?></a></h5>
                        <p class="card-text">Chapter. <?=$c['chap_total']?></p>
                        <p class="card-text"><small class="text-muted text-uppercase">Update 1 Hour ago</small></p>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <!-- end lastest -->
    <?php include_once PATH_VIEW_CLIENT . 'layout/footer.php'; ?>
