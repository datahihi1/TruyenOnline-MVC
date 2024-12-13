<?php 
    require_once '../../env.php';

  function isActivePath($path) {
    $current_path = $_SERVER["REQUEST_URI"];
    echo $current_path == $path ? "text-primary" : "";
  }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <a class="navbar-brand" href="">
    <img src="static/images/logo-zalopay.svg" alt="Logo ZaloPay" />
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link <?php isActivePath(ZALO_PAYMENT.'history.php') ?>" href="<?=ZALO_PAYMENT?>history.php">Lịch sử</a>
      </li>
    </ul>
  </div>
</nav>