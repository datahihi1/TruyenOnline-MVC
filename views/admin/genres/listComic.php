<?php include_once PATH_VIEW_ADMIN . 'layout/header.php'; ?>
<?php if (isset($_SESSION['app_err'])): ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['app_err'];
    unset($_SESSION['app_err']); ?>
    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>
<h1 class="mt-4">Danh sách truyện liên kết với thể loại</h1>

<?php if ($comics): ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Comics name</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($comics as $c) : ?>
        <tr>
          <td><?= $c['comic_name'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Không có truyện được liên kết</p>
<?php endif; ?>

<a class="btn btn-light" href="<?= BASE_URL_ADMIN . '&act=genres-list' ?>">Cancel</a>

<?php include_once PATH_VIEW_ADMIN . 'layout/footer.php'; ?>