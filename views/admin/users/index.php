<?php include_once PATH_VIEW_ADMIN.'layout/header.php';?>
<h1 class="mt-4">Danh sách người dùng</h1>
<table class="table table-hover">
<thead>
    <tr>
      <th>STT</th>
      <th>Username</th>
      <th>Email</th>
      <th>Avatar</th>
      <th>Coin</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $key=>$u):?>
    <tr>
        <td><?=$key + 1?></td>
        <td><?=$u['username']?></td>
        <td><?=$u['email']?></td>
        <td>
        <?php if (!empty($u['avatar'])): ?>
          <img class="circle-img" src="<?= AVATAR_UPLOAD . $u['avatar'] ?>" width="100px">
        <?php else:?>
          <p>K.có ảnh</p>
        <?php endif; ?>
        </td>
        <td><?=$u['coin']?></td>
        <td><?=$u['role'] ? 'Admin':'User'?></td>
        <td>
            <div class="dropdown">
                <button class="btn btn-sm" type="button" id="ddButton" data-bs-toggle="dropdown">
                    Choose action
                </button>
                <ul class="dropdown-menu" aria-labelledby="ddButton" >
                    <li><a class="dropdown-item" href="#"><?=$u['user_id']?></a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<?php include_once PATH_VIEW_ADMIN.'layout/footer.php';?>