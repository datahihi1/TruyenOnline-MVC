<?php include_once PATH_VIEW_ADMIN.'layout/header.php';?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h1 class="mt-4">Danh sách thể loại</h1>
<a type="button" class="btn btn-success" href="<?=BASE_URL_ADMIN.'&act=genres-create'?>">
    <i class="bi bi-plus-circle"></i>  Thêm mới
</a>
<table class="table table-hover">
<thead>
    <tr>
      <th>ID</th>
      <th>Genre</th>
      <th>Description</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($genres as $g):?>
    <tr>
        <td><?=$g['genre_id']?></td>
        <td><?=$g['name']?></td>
        <td><?=$g['description'] ?? 'No description'?></td>
        <td>
            <div class="dropdown">
                <button class="btn btn-sm" type="button" id="ddButton" data-bs-toggle="dropdown">
                    Choose action
                </button>
                <ul class="dropdown-menu" aria-labelledby="ddButton" >
                    <li><a class="dropdown-item" 
                    href="<?=BASE_URL_ADMIN.'&act=genres-comic&genre_id='.$g['genre_id']?>">List comic</a></li>
                    <li><a class="dropdown-item" 
                    href="<?=BASE_URL_ADMIN.'&act=genres-edit&genre_id='.$g['genre_id']?>">Edit Genres</a></li>
                    <li><a class="dropdown-item" 
                    href="<?=BASE_URL_ADMIN.'&act=genres-delete&genre_id='.$g['genre_id']?>">Delete Genres</a></li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<?php include_once PATH_VIEW_ADMIN.'layout/footer.php';?>