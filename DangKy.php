<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
    		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

//			 Kiểm tra xác nhận mật khẩu
			if ($password !== $confirm_password) {
				echo "Mật khẩu và xác nhận mật khẩu không khớp. Vui lòng thử lại.";
				exit;
			}

			// Kiểm tra tên người dùng và email đã tồn tại
			$stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE TenDN = :username OR Email = :email");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
			$count = $stmt->fetchColumn();

			if ($count > 0) {
				echo "Tên người dùng hoặc email đã tồn tại. Vui lòng chọn tên hoặc email khác.";
				exit;
			}

			// Thực hiện truy vấn SQL để thêm người dùng mới
			$stmt = $pdo->prepare("INSERT INTO user (TenDN, Email, MatKhau) VALUES (:username, :email, :password)");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);

			if ($stmt->execute()) {
				echo "Đăng ký thành công!";
			} else {
				echo "Đăng ký không thành công. Vui lòng thử lại.";
			}
		}
		?>


<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Đăng Ký</h2>
            <form method="POST" action="DangKy.php" class="mt-4" id="registerForm">
                <div class="form-group">
                    <label for="register-username">Tên người dùng</label>
                    <input type="text" class="form-control" id="register-username" name="username" placeholder="Nhập tên người dùng" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Mật khẩu</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
                <div class="text-center mt-3">
                    <p>Đã có tài khoản? <a href="DangNhap.php">Đăng nhập ngay</a></p>
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