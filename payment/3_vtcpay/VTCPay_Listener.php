<?php
// VTCPAY Payment Notification (BPN) Sample
$host = "localhost";
$user = "root";
$pass = "";
$data = "id_zubi";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$data;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function verifyPaymentUrl($status, $reference_number, $amount, $website_id, $sign)
{
    $secret_key = "Secrete Key"; // Mã bảo mật lấy ở phần tạo WebsiteID trên VTCPAY
    $plaintext = $status . "|" . $website_id . "|" . $reference_number . "|" . $amount . "|" . $secret_key;

    // Mã hóa sign
    $verify_secure_code = strtoupper(hash('sha256', $plaintext));

    // Xác thực chữ ký của chủ web với chữ ký trả về từ VTC Pay
    if ($verify_secure_code === $sign) {
        return strval($status);
    }

    return false;
}

if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = $_GET['status'] ?? '';
    $reference_number = $_GET['reference_number'] ?? '';
    $amount = $_GET['amount'] ?? '';
    $website_id = $_GET['website_id'] ?? '';
    $sign = $_GET['sign'] ?? '';
    $url = ""; // URL website của bạn

    $check = verifyPaymentUrl($status, $reference_number, $amount, $website_id, $sign);

    if ($check === false) {
        echo 'Chữ ký sai, có sự can thiệp từ bên ngoài <br/><a href="' . $url . '">Quay lại</a>';
    } else {
        $thongtin = "";
        $statusText = "Unpaid";

        if ($check == 1 || $check == 2) {
            $statusText = "Paid";
            $thongtin = "Thanh toán thành công! Orderid: $reference_number, Error: $status, Price: $amount";
        } elseif ($check == 0) {
            $thongtin = "Thanh toán đang xử lý! Orderid: $reference_number, Error: $status, Price: $amount";
        } elseif ($check == -1) {
            $thongtin = "Giao dịch thất bại! Orderid: $reference_number, Error: $status, Price: $amount";
        } elseif ($check == -5) {
            $thongtin = "Mã đơn hàng không hợp lệ! Orderid: $reference_number, Error: $status, Price: $amount";
        } elseif ($check == -6) {
            $thongtin = "Số dư không đủ thanh toán! Orderid: $reference_number, Error: $status, Price: $amount";
        } else {
            $thongtin = "Có lỗi. Hãy thực hiện lại! Orderid: $reference_number, Error: $status, Price: $amount";
        }

        try {
            $stmt = $pdo->prepare("UPDATE tblinvoices SET status = :status, paymentmethod = 'VTCPAY', notes = :notes WHERE id = :id");
            $stmt->execute([
                ':status' => $statusText,
                ':notes' => $thongtin,
                ':id' => $reference_number
            ]);

            echo $statusText === "Paid" ? "Thanh toán thành công!<br/><a href=\"$url\">Quay lại</a>" :
                'Có lỗi hoặc đang xử lý.<br/><a href="' . $url . '">Quay lại</a>';
        } catch (PDOException $e) {
            echo 'Lỗi khi cập nhật cơ sở dữ liệu: ' . $e->getMessage();
        }
    }
}
?>
