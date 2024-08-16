<?php
	session_start();

	$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
	?>

<?php
$pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
$pdo->query("set names utf8");

// Lấy danh sách hóa đơn
$sql = "SELECT * FROM hoa_don";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$danh_sach_hoa_don = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Xử lý cập nhật trạng thái
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ma_hoa_don'], $_POST['trang_thai'])) {
    $ma_hd = $_POST['ma_hoa_don'];
    $trang_thai = $_POST['trang_thai'];

    $sql_update = "UPDATE hoa_don SET trang_thai = ? WHERE ma_hoa_don = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$trang_thai, $ma_hd]);

    header("Location: QLHD.php");
    exit();
}

// Xử lý xóa hóa đơn
if (isset($_POST["ma_hoa_don"])) {
    $ma_hd = $_POST["ma_hoa_don"];

    // Xóa bản ghi trong bảng chi tiết hóa đơn (cthd)
    $sql_delete_cthd = "DELETE FROM chi_tiet_hoa_don WHERE ma_hoa_don = ?";
    $stmt_delete_cthd = $pdo->prepare($sql_delete_cthd);
    $stmt_delete_cthd->execute([$ma_hd]);

    // Xóa bản ghi trong bảng hóa đơn
    $sql_delete_hd = "DELETE FROM hoa_don WHERE ma_hoa_don = ?";
    $stmt_delete_hd = $pdo->prepare($sql_delete_hd);
    $stmt_delete_hd->execute([$ma_hd]);

    header("Location: QLHD.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pomato Store</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .dd_sp {
            width: 32%;
            border: 1px solid grey;
            float: left;
            margin: 5px;
        }
    </style>
</head>
<body class="main-layout">
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="TrangChu.php"><img src="images/logo_pomato.png" alt="#" width="100px" height="100px"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">
									 <li class="active"> <a href="TrangChu.php">Trang chủ</a> </li>
									 <li><a href="brand.php">Sản phẩm</a></li>

									 <?php if ($isLoggedIn): ?>
										 <li><a href="QuanLyTaiKhoan.php"><i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?></a></li>
										 <li><a href="logout.php">Đăng xuất</a></li>
									 <?php else: ?>
										 <li><a href="DangKy.php">Đăng ký</a></li>
										 <li><a href="DangNhap.php">Đăng nhập</a></li>
									 <?php endif; ?>

									 <li class="last">
										 <a href="ShowCart.php"><i class="bi bi-cart" width="200px"></i></a>
									 </li>
								 </ul>

                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-6">
                        <div class="location_icon_bottum">
                            <ul>
                                <li><img src="icon/call.png" />(+71)9876543109</li>
                                <li><img src="icon/email.png" />pomato@gmail.com</li>
                                <li><img src="icon/loc.png" />Location</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="brand_color">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <div class="titlepage">
                        <h2>Pomato Store</h2>
                    </div>
                </div>
                <div class="col-md-10">
                    <form action="brand.php" method="GET" class="form-inline justify-content-end">
                        <div class="input-group" style="max-width: 600px; width: 100%;">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="txt_Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="Content" class="row">
        <div class="col-3">
            <ul class="list-group list-group-flush text-left bg-light">
                <li class="list-group-item" style="background-color:black"><a href="#" style="text-transform:uppercase; text-decoration:none; color:white; font-weight:bold;">Chức năng</a></li>
                <li class='list-group-item bg-light'><a href="Admin.php">Quản lý sản phẩm</a></li>
                <li class='list-group-item bg-light'><a href="Admin_KH.php">Quản lý khách hàng</a></li>
                <li class='list-group-item bg-light'><a href="QLHD.php">Quản lý hóa đơn</a></li>
                <li class='list-group-item bg-light'><a href="AdminTK.php">Quản lý tài khoản</a></li>
                <li class='list-group-item bg-light'><a href="SanPhamAPI.php">DSSP API</a></li>
            </ul>
        </div>
        <div class="col-9">
            <h2 class="my-4 text-center">TRANG QUẢN LÝ HÓA ĐƠN</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã HD</th>
                        <th>Mã KH</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Hình thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th>CRUD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($danh_sach_hoa_don as $hd): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($hd["ma_hoa_don"]); ?></td>
                        <td><?php echo htmlspecialchars($hd["ma_khach_hang"]); ?></td>
                        <td><?php echo htmlspecialchars($hd["ngay_dat"]); ?></td>
                        <td><?php echo number_format($hd["tong_tien"], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($hd["hinh_thuc_thanh_toan"]); ?></td>
                        <td>
                            <form method="post" action="QLHD.php" style="display: inline-block;">
                                <select name="trang_thai" class="form-control" style="width: auto; display: inline-block;">
                                    <option value="Đang chờ xử lý" <?php echo $hd["trang_thai"] === 'Đang chờ xử lý' ? 'selected' : ''; ?>>Đang chờ xử lý</option>
                                    <option value="Đã xử lý" <?php echo $hd["trang_thai"] === 'Đã xử lý' ? 'selected' : ''; ?>>Đã xử lý</option>
                                    <option value="Đã giao" <?php echo $hd["trang_thai"] === 'Đã giao' ? 'selected' : ''; ?>>Đã giao</option>
                                    <option value="Đã hủy" <?php echo $hd["trang_thai"] === 'Đã hủy' ? 'selected' : ''; ?>>Đã hủy</option>
                                </select>
                                <input type="hidden" name="ma_hoa_don" value="<?php echo htmlspecialchars($hd["ma_hoa_don"]); ?>">
                                <button class="btn btn-info" type="submit">Cập nhật</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="QLHD.php" style="display: inline-block;">
                                <input type="hidden" name="ma_hoa_don" value="<?php echo htmlspecialchars($hd["ma_hoa_don"]); ?>">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này không?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div id="contact" class="footer">
            <div class="container">
                <div class="row pdn-top-30">
                    <div class="col-md-12">
                        <div class="footer-box">
                            <div class="headinga">
                                <h3>Địa chỉ</h3>
                                <span>Trung tâm chữa lành, 176 Đường Tên Lửa, Bình Tân, TP HCM</span>
                                <p>(+71) 8522369417<br>pomato@gmail.com</p>
                            </div>
                            <ul class="location_icon">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <div class="menu-bottom">
                                <ul class="link">
                                    <li><a href="TrangChu.php">Trang chủ</a></li>
                                    <li><a href="#">Về chúng tôi</a></li>
                                    <li><a href="#">Thương hiệu</a></li>
                                    <li><a href="#">Ưu đãi đặc biệt</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
            $(".zoom").hover(function() {
                $(this).addClass('transition');
            }, function() {
                $(this).removeClass('transition');
            });
        });
    </script>
</body>
</html>
