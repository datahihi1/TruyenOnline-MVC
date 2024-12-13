<?php include_once PATH_VIEW_ADMIN.'layout/header.php';?>
<?php if (isset($_SESSION['app_err'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['app_err'];
        unset($_SESSION['app_err']); ?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<h1 class="mt-4">Danh sách người dùng mua truyện</h1>
<table class="table table-hover">
<thead>
    <tr>
      <th>STT</th>
      <th>User Buy</th>
      <th>Comic Name</th>
      <th>Price</th>
      <th>Time Bought</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($bought as $key=>$b):?>
    <tr>
        <td><?=$key + 1?></td>
        <td><?=$b['username']?></td>
        <td><?=$b['comic_name']?></td>
        <td><?=$b['price']?> coins</td>
        <td><?=$b['time_bought']?> </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<?php include_once PATH_VIEW_ADMIN.'layout/footer.php';?>