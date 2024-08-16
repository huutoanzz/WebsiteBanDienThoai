<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Update Account</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
        .dd_sp {
            width: 32%;
            border: 1px solid grey;
            float: left;
            margin: 5px;
        }
    </style>
</head>

<?php
    $pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
    $pdo->query("set names utf8");

    $message = "";
    if (isset($_POST["btnUpdate"])) {
        $id = $_POST["id"];
        $username = $_POST["txtUsername"];
        $email = $_POST["txtEmail"];
        $role = $_POST["txtRole"];
        
        $password = !empty($_POST["txtPassword"]) ? $_POST["txtPassword"] : null;

        if ($password) {
            $sql = "UPDATE user SET TenDN = ?, MatKhau = ?, Email = ?, Role = ? WHERE id = ?";
            $params = [$username, $password, $email, $role, $id];
        } else {
            $sql = "UPDATE user SET TenDN = ?, Email = ?, Role = ? WHERE id = ?";
            $params = [$username, $email, $role, $id];
        }

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute($params);

        if ($result) {
            $message = "Cập nhật tài khoản thành công";
        } else {
            $message = "Cập nhật tài khoản không thành công";
        }
    }

    // Fetch user details to populate the form
    if (isset($_GET["user_id"])) {
        $id = $_GET["user_id"];
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<body class="main-layout">
    <!-- header -->
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
                                        <li class="active"><a href="TrangChu.php">Trang chủ</a></li>
                                        <li><a href="TrangChu.php">Giới thiệu</a></li>
                                        <li><a href="brand.php">Sản phẩm</a></li>
                                        <li><a href="DangKy.php">Đăng ký</a></li>
                                        <li><a href="DangNhap.php">Đăng nhập</a></li>
                                        <li class="last">
                                            <a href="#"><img src="images/search_icon.png" alt="icon" /></a>
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
    <!-- end header -->

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
                                <a href="ShowCart.php"><i class="bi bi-cart" width="200px"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- brand -->
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
			<h2 align="center">CẬP NHẬT TÀI KHOẢN</h2>
			<br/><br/><br/>
			<?php if ($message): ?>
				<div class="alert alert-info"><?php echo $message; ?></div>
			<?php endif; ?>

			<?php if (isset($user)): ?>
				<form method="post" action="UpdateTK.php">
					<input type="hidden" name="id" value="<?php echo $user['id']; ?>">

					<div class="form-group">
						<label for="txtUsername">Tên tài khoản:</label>
						<input type="text" class="form-control" id="txtUsername" name="txtUsername" value="<?php echo $user['TenDN']; ?>" >	
					</div>

					<div class="form-group">
						<label for="txtEmail">Email:</label>
						<input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $user['Email']; ?>" >
					</div>

					<div class="form-group">
						<label for="txtPassword">Mật khẩu mới:</label>
						<input type="password" class="form-control" id="txtPassword" name="txtPassword">
						<small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
					</div>

					<div class="form-group">
						<label for="txtRole">Vai trò:</label>
						<input type="text" class="form-control" id="txtRole" name="txtRole" value="<?php echo $user['Role']; ?>" >
					</div>

					<button type="submit" class="btn btn-primary" name="btnUpdate">Cập nhật</button>
				</form>
			<?php else: ?>
				<div class="alert alert-danger">Không tìm thấy tài khoản.</div>
			<?php endif; ?>

		</div>

    </div>
    <!-- end brand -->

    <!-- footer -->
    <footer>
        <div id="contact" class="footer">
            <div class="container">
                <div class="row pdn-top-30">
                    <div class="col-md-12 ">
                        <div class="footer-box">
                            <div class="headinga">
                                <h3>Địa chỉ</h3>
                                <span>Trung tâm chữa lành, 176 Đường Tên Lửa, Bình Tân, TP HCM</span>
                                <p>(+71) 8522369417
                                    <br>pomato@gmail.com</p>
                            </div>
                            <ul class="location_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <div class="menu-bottom">
                                <ul class="link">
                                    <li> <a href="TrangChu.php">Trang chủ</a></li>
                                    <li> <a href="#">Về chúng tôi</a></li>
                                    <li> <a href="#">Thương hiệu</a></li>
                                    <li> <a href="#">Ưu đãi đặc biệt</a></li>
                                    <li> <a href="#">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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
