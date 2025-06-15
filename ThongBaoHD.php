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
$mail->CharSet = 'UTF-8';
$mail->SMTPAuth = true;
$mail->Username = '';  // Thay đổi với email của bạn
$mail->Password = '';     // Thay đổi với mật khẩu ứng dụng của bạn
$mail->SMTPSecure = 'tls'; // Hoặc 'ssl' nếu bạn sử dụng cổng 465
$mail->Port = 587; // Cổng 587 cho TLS hoặc 465 cho SSL

$mail->setFrom('toanphan799@gmail.com', 'Thế Giới Di Động Nguyễn Hữu Trí');

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

$mail->Body = "
<html>
<head>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color:rgb(0, 0, 0);
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 30px;
        }
        h2 {
            color:rgb(0, 0, 0);
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .order-details {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dedede;
        }
        th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
            color: #d32f2f;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .footer a {
            color:rgb(92, 126, 250);
            background-color:rgb(254, 252, 252);
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(4, 4, 4);
            color: #f9f9f9;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <img src='https://cdn.haitrieu.com/wp-content/uploads/2021/11/Logo-The-Gioi-Di-Dong-MWG-Y-V.png' alt='Thế Giới Di Động Logo'>
        </div>
        <div class='content'>
            <h2>Xin chào $fullName,</h2>
            <p>Cảm ơn bạn đã mua sắm tại <strong>Thế Giới Di Động Nguyễn Hữu Trí</strong>. Dưới đây là thông tin chi tiết về đơn hàng của bạn:</p>
            <div class='order-details'>
                <p><strong>Địa chỉ giao hàng:</strong> $address</p>
                <p><strong>Số điện thoại:</strong> $phone</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Chi tiết đơn hàng:</strong></p>
                <table>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>";
foreach ($cartItems as $cartItem) {
    $mail->Body .= "<tr>
                        <td>{$cartItem['tenSP']}</td>
                        <td>{$cartItem['sl']}</td>
                        <td>" . number_format($cartItem['donGia'], 0, ',', '.') . " VND</td>
                        <td>" . number_format($cartItem['donGia'] * $cartItem['sl'], 0, ',', '.') . " VND</td>
                    </tr>";
}
$mail->Body .= "</table>
                <p class='total'>Tổng cộng: " . number_format($total, 0, ',', '.') . " VND</p>
            </div>
            <p>Chúng tôi sẽ thông báo khi đơn hàng của bạn được xử lý và giao hàng. Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ:</p>
            <a href='mailto:toanphan799@gmail.com' class='button'>Liên hệ hỗ trợ</a>
        </div>
        <div class='footer'>
            <p><strong>Thế Giới Di Động Nguyễn Hữu Trí</strong><br>
            Hotline: 1800-1060 | Email: <a href='mailto:toanphan799@gmail.com'>cskh@thegioididong.com</a><br>
            Website: <a href='https://www.thegioididong.com'>www.thegioididong.com</a></p>
            <p>Trân trọng,<br>Đội ngũ Thế Giới Di Động</p>
        </div>
    </div>
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
