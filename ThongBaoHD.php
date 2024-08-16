<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- CSS để tạo thông báo -->
    <style>
        .alert {
            padding: 20px;
            background-color: #28a745; /* Màu nền của thông báo (xanh lá cây) */
            color: white; /* Màu chữ */
            margin-bottom: 20px; /* Khoảng cách với phần dưới */
        }
        .alert:hover {
            opacity: 0.9;
        }
        .alert .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .alert .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>
<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/class.phpmailer.php';
require 'PHPMailer/class.smtp.php';

// Kết nối với database
$pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
$pdo->query("set names utf8");

// Lấy thông tin khách hàng từ form
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Lưu thông tin khách hàng vào bảng "khach_hang"
$stmt = $pdo->prepare("INSERT INTO khach_hang (ten_khach_hang, email, dia_chi, dien_thoai) VALUES (:fullName, :email, :address, :phone)");
$stmt->bindParam(':fullName', $fullName);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':phone', $phone);
if ($stmt->execute()) {
    $customerId = $pdo->lastInsertId();
    echo "Thông tin khách hàng đã được lưu vào database.";
} else {
    echo "Lỗi khi lưu thông tin khách hàng: " . $stmt->errorInfo()[2];
}

session_start();
$cartItems = $_SESSION['cart'];
$total = 0;
foreach ($cartItems as $item) {
    $subtotal = $item['sl'] * $item['donGia'];
    $total += $subtotal;
}

// Lưu thông tin đơn hàng vào bảng "hoa_don"
$stmt = $pdo->prepare("INSERT INTO hoa_don (ma_khach_hang, tong_tien, ngay_dat) VALUES (:ma_khach_hang, :tong_tien, NOW())");
$stmt->bindParam(':ma_khach_hang', $customerId);
$stmt->bindParam(':tong_tien', $total);
if ($stmt->execute()) {
    $orderId = $pdo->lastInsertId();
    echo "Đơn hàng đã được lưu vào database.";
} else {
    echo "Lỗi khi lưu đơn hàng: " . $stmt->errorInfo()[2];
}

foreach ($cartItems as $item) {
    if (!empty($item['maSP'])) {
        $stmt = $pdo->prepare("INSERT INTO chi_tiet_hoa_don (ma_hoa_don, ma_sp, so_luong, don_gia) VALUES (:ma_hoa_don, :ma_sp, :so_luong, :don_gia)");
        $stmt->bindParam(':ma_hoa_don', $orderId);
        $stmt->bindParam(':ma_sp', $item['maSP']);
        $stmt->bindParam(':so_luong', $item['sl']);
        $stmt->bindParam(':don_gia', $item['donGia']);
        if ($stmt->execute()) {
            echo "Chi tiết đơn hàng đã được lưu vào database.";
        } else {
            echo "Lỗi khi lưu chi tiết đơn hàng: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Không thể lưu chi tiết đơn hàng vì không có mã sản phẩm.";
    }
}

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'toanphan799@gmail.com';  // Thay đổi với email của bạn
$mail->Password = 'ptun tlxr fkmw hbrl';     // Thay đổi với mật khẩu ứng dụng của bạn
$mail->SMTPSecure = 'tls'; // Hoặc 'ssl' nếu bạn sử dụng cổng 465
$mail->Port = 587; // Cổng 587 cho TLS hoặc 465 cho SSL

$mail->setFrom('toanphan799@gmail.com', 'Phan Huu Toan');
$mail->addAddress($email, $fullName);

$mail->isHTML(true);
$mail->Subject = 'Xác nhận đơn hàng của bạn';
$mail->Body    = "
    <html>
    <head>
    <title>Xác nhận đơn hàng của bạn</title>
    </head>
    <body>
    <h2>Xin chào $fullName,</h2>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là chi tiết đơn hàng của bạn:</p>
    <p><strong>Địa chỉ:</strong> $address</p>
    <p><strong>Số điện thoại:</strong> $phone</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Sản phẩm:</strong></p>
    <ul>";

foreach ($cartItems as $cartItem) {
    $mail->Body .= "<li>{$cartItem['tenSP']} - Số lượng: {$cartItem['sl']} - Giá: " . number_format($cartItem['donGia'], 0, ',', '.') . " VND</li>";
}

$mail->Body .= "</ul>
    <p><strong>Tổng cộng:</strong> " . number_format($total, 0, ',', '.') . " VND</p>
    </body>
    </html>";

if(!$mail->send()) {
    echo 'Không thể gửi email xác nhận. Lỗi: ' . $mail->ErrorInfo;
} else {
    echo 'Email xác nhận đã được gửi thành công.';
}
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="alert">
                <span class="closebtn" onclick="window.location.href = 'TrangChu.php';">&times;</span> 
                <h4 class="mb-3">Thông báo!</h4>
                <p>Đặt hàng của bạn đã được ghi lại thành công. Dưới đây là chi tiết đơn hàng:</p>
                <ul>
                    <li><strong>Họ và tên:</strong> <?php echo $_POST['full_name']; ?></li>
                    <li><strong>Email:</strong> <?php echo $_POST['email']; ?></li>
                    <li><strong>Địa chỉ:</strong> <?php echo $_POST['address']; ?></li>
                    <li><strong>Số điện thoại:</strong> <?php echo $_POST['phone']; ?></li>
                    <li><strong>Tổng cộng:</strong> <?php echo number_format($total, 0, ',', '.'); ?> VND</li>
                </ul>
                <a href="TrangChu.php" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
