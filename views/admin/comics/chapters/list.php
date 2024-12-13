<?php include_once PATH_VIEW_ADMIN.'layout/header.php';?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h1 class="mt-4">Danh sách chương truyện: <?=$comic['comic_name']?></h1>
<a type="button" class="btn btn-success" href="<?= BASE_URL_ADMIN . '&act=chapters-create&comic_id='.$comic['comic_id'] ?>">
    <i class="bi bi-plus-circle"></i> Thêm chương mới
</a>
<table class="table table-hover">
<thead>
    <tr>
      <th>STT</th>
      <th>Số chương</th>
      <th>Tiêu đề</th>
      <th>Đường dẫn ảnh</th>
      <th>Lượt xem</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($chapter as $key=>$ch):?>
    <tr>
        <td><?=$key + 1?></td>
        <td><?=$ch['chap_number']?></td>
        <td><?=$ch['title']?></td>
        <td><?=$ch['img_content']?></td>
        <td><?=$ch['view_count']?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<a class="btn btn-light" href="<?=BASE_URL_ADMIN .'&act=comics-list'?>">Cancel</a>

<?php include_once PATH_VIEW_ADMIN.'layout/footer.php';?>