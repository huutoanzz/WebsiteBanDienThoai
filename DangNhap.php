<?php
session_start();

// Kiểm tra xem người dùng đã gửi yêu cầu POST hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Thiết lập chế độ báo lỗi

    // Lấy thông tin đăng nhập từ biểu mẫu
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Tạo truy vấn SQL để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM user WHERE TenDN = :username AND MatKhau = :password";

    // Chuẩn bị và thực thi truy vấn SQL
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password]);

    // Kiểm tra xem có bản ghi nào khớp với thông tin đăng nhập không
    if ($stmt->rowCount() > 0) {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['TenDN'];
        $_SESSION['role'] = $user['Role'];
        $_SESSION['logged_in'] = true;

        // Chuyển hướng người dùng đến trang tương ứng với vai trò của họ
        if ($user['Role'] == 1) {
            header("Location: Admin.php");
        } else {
            header("Location: TrangChu.php");
        }
        exit(); 
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác');</script>";
    }

    // Đóng kết nối đến cơ sở dữ liệu
    $pdo = null;
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .social-icons a {
            margin: 0 10px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Đăng Nhập</h2>
            <form method="POST" action="DangNhap.php" class="mt-4" id="loginForm">
                <div class="form-group">
                    <label for="login-username">Tên người dùng</label>
                    <input type="text" class="form-control" id="login-username" name="username" placeholder="Nhập tên người dùng" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Mật khẩu</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                <div class="text-center mt-3">
                    <p>Chưa có tài khoản? <a href="DangKy.php">Đăng ký ngay</a></p>
                </div>
                <div class="text-center mt-3 social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
				<div class="text-center">
                    <a href="TrangChu.php">Về trang chủ</a>
                </div>
				
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
