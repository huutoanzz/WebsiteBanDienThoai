<?php
session_start();
session_destroy(); // Hủy phiên làm việc của người dùng
header("Location: DangNhap.php"); // Chuyển hướng đến trang đăng nhập
exit();
?>