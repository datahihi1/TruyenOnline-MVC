<?php 
  require "zalopay/helper.php";
  require "repository/order_repository.php";
  require_once '../../env.php';

  $is_post_method = $_SERVER['REQUEST_METHOD'] === 'POST';
  $order = NULL;
  $error = NULL;

  if ($is_post_method) {
    $amount = (int)$_POST["amount"];
    if ($amount < 1000) {
      $error = "Số tiền yêu cầu tối thiểu là 1.000đ";
    } else {
      $orderData = ZaloPayHelper::newCreateOrderData($_POST);
      $order = ZaloPayHelper::createOrder($orderData);

      if ($order["returncode"] === 1) {
        OrderRepository::add($orderData);
      } else {
        $error = "Tạo đơn hàng thất bại";
      }
    }
  }
?>

<?php if (isset($error)) { ?>
  <script>
    alert('<?php echo $error; ?>');
  </script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<?php include "components/head.php"; ?>
<body>
  <?php include "components/navbar.php"; ?>
  <h3 class="text-center text-primary my-4 font-weight-bold">QRCode / Mobile Web to App</h3>
  <form class="container mt-5" action="." method="POST">
    <?php if (isset($order)) { ?>
      <?php if ($order["returncode"] === 1) { ?>
        <script>
          window.open('<?php echo $order["orderurl"] ?>')
        </script>
      <?php } ?>
    <?php } ?>
    <div class="form-group">
      <label for="description">Mô tả</label>
      <textarea type="text" class="form-control" name="description" placeholder="Nhập mô tả"></textarea>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Số tiền <span class="text-danger">*</span></label>
      <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền" value="1000">
      <small class="form-text text-muted">Số tiền tối thiểu là 1000 VNĐ</small>
    </div>
    <button type="submit" class="btn btn-primary">Thanh toán</button>
  </form>
</body>
</html>