<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h1 class="mt-4">Thêm thể loại mới</h1>
<form action="<?= BASE_URL_ADMIN . '&act=genres-store' ?>" method="post">
    <div class="mb-3">
        <label for="genre" class="form-label">Genre name</label>
        <input type="text" class="form-control" name="genre">

    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description(Option)</label>
        <input type="text" class="form-control" name="description">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-light" href="<?=BASE_URL_ADMIN .'&act=genres-list'?>">Cancel</a>
</form>
<?php include_once PATH_VIEW_ADMIN . 'layout/footer.php'; ?>