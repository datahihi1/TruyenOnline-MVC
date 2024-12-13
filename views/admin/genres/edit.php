<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h1 class="mt-4">Câp nhật thể loại: <?=$genres['name']?></h1>
<form action="<?= BASE_URL_ADMIN . '&act=genres-update&genre_id='.$genres['genre_id'] ?>" method="post">
    <input type="hidden" name="genre_id" value="<?=$genres['genre_id']?>">
    <div class="mb-3">
        <label for="genre" class="form-label">Genre name</label>
        <input type="text" class="form-control" name="genre" value="<?=$genres['name']?>">

    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description(Option)</label>
        <input type="text" class="form-control" name="description"  value="<?=$genres['description']?>">
    </div>

    <button type="submit" class="btn btn-warning">Submit</button>
    <a class="btn btn-light" href="<?=BASE_URL_ADMIN .'&act=genres-list'?>">Cancel</a>
</form>
<?php include_once PATH_VIEW_ADMIN . 'layout/footer.php'; ?>