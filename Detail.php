<?php
	session_start();

	$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
	?>


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
    <title>pomato</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
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
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<style>
		.product-detail {
			display: flex;
			margin: 20px 0;
			border: 1px solid #ddd;
			padding: 20px;
			align-items: flex-start;
		}

		.product-image {
			flex: 1;
			max-width: 40%;
			margin-right: 20px;
		}

		.product-image img {
			width: 500px;
			height: auto;
			object-fit: cover;
		}

		.product-info {
			flex: 2;
		}

		.product-info p {
			margin: 10px 0;
		}

		.form-inline {
			display: flex;
			align-items: center;
		}

		.form-inline .form-group {
			display: flex;
			align-items: center;
			margin-right: 10px;
		}

		.form-inline .form-group input[type="number"] {
			width: 70px;
			margin-right: 10px;
		}

		.form-inline .form-group button {
			margin-left: 10px;
		}
		
		.brand_color .titlepage {
			text-align: left;
		}

		.brand_color .form-inline {
			display: flex;
			justify-content: flex-end;
			width: 100%;
		}

		.brand_color .input-group {
			width: 100%;
			max-width: 400px;
		}


    </style>
	
	<?php
		///Load loai sp
		$pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
		$pdo->query("set names utf8");
		$sql = "SELECT ma_loai,ten_loai,mo_ta FROM loai_san_pham";
		$loai_san_pham = $pdo->query($sql);
		$pdo = null;
		///Load sp theo ma loai
		$pdo1 = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
		$pdo1->query("set names utf8");
		$sql1 = "select ma_sp, ten_sp, nd_tom_tat,ma_loai, don_gia, hinh from san_pham";
		if (isset($_GET['ml'])) {
			if ($_GET["ml"] == NULL) {
				$ml = 0;
			} else {
				$ml = $_GET["ml"];
			}

			if ($ml == 0) {
				$sql1 = "select * from san_pham";
			} else {
				$sql1 = "select * from san_pham where ma_loai =".$ml;
			}
		}
		$san_pham = $pdo1->query($sql1);
		$pdo1 = null;
		//Tim kiem
		$pdo2 = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
		$pdo2->query("set names utf8");
		if(isset($_GET["txt_Search"]))
		{
			$Ten = $_GET["txt_Search"];
			$sql2 = "select * from san_pham where ten_sp like '%".$Ten."%'";
			$san_pham2 = $pdo2->query($sql2);
			$pdo2 = null;
		}
	
		// sp theo Giá
		$pdo3 = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
		$pdo3->query("set names utf8");
		if(isset($_GET['gt']) && isset($_GET['gc']))
		{
			$gt = $_GET['gt'];
			$gc = $_GET['gc'];
			if ($gt == 0 && $gc ==0)
				$sql3 = "select * from san_pham";
			else
				$sql3 = "select * from san_pham where don_gia >".$gt."&& don_gia<=".$gc;

			$san_pham3 = $pdo3->query($sql3);
			$pdo3 = NULL;
		}
	
		// Chi Tiết
		$pdo4 = new PDO("mysql:host=localhost;dbname=ql_dien_thoai", "root", "");
		$pdo4->query("set names utf8");
		if (isset($_GET['id'])) {   
			$maSP = $_GET["id"];
			$sql4 = "SELECT * FROM san_pham WHERE ma_sp = :maSP"; 
			
			$stmt = $pdo4->prepare($sql4);
			$stmt->bindParam(':maSP', $maSP, PDO::PARAM_INT);

			try {
				$stmt->execute();
				$san_pham4 = $stmt->fetchAll();
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$pdo4 = null;
				}
	?>
	
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
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
        <!-- end header inner -->
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
								<button type="submit" class="btn btn-primary">Search</button>
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
                    <li class="list-group-item" style="background-color:black"><a href="#" style="text-transform:uppercase; text-decoration:none; color:white; font-weight:bold;">Loại Sản Phẩm</a></li>
                    <?php
						foreach ($loai_san_pham as $loai)
						{	
					?>
                  	<li class='list-group-item bg-light'><a href="brand.php?ml=<?php echo $loai["ma_loai"] ?>&&tl=<?php echo $loai["ten_loai"] ?>"><?php echo $loai['ten_loai'];?></a></li>
                   <?php
						}
					?>
                   <li class='list-group-item bg-light'><a href="brand.php?ml=0">Tất cả sản phẩm</a></li>
                   
                </ul>
                <ul class="list-group list-group-flush text-left bg-light">
					<li class="list-group-item" style="background-color:red;">
						<a href="#" style="text-transform:uppercase; text-decoration:none; color:white; font-weight:bold;">Chọn theo giá</a>
					</li>
					<li class="list-group-item bg-light"><a href="brand.php?gt=0&gc=2000000">Dưới 2,000,000đ</a></li>
					<li class="list-group-item bg-light"><a href="brand.php?gt=2000000&gc=5000000">2,000,000đ - 5,000,000đ</a></li>
					<li class="list-group-item bg-light"><a href="brand.php?gt=5000000&gc=10000000">5,000,000đ - 10,000,000đ</a></li>
					<li class="list-group-item bg-light"><a href="brand.php?gt=10000000&gc=20000000">10,000,000đ - 20,000,000đ</a></li>
					<li class="list-group-item bg-light"><a href="brand.php?gt=20000000&gc=50000000">Trên 20,000,000đ</a></li>
				</ul>
            </div>
			<div class="col-9">
			<h2 align="center" style="color:#900;">THÔNG TIN CHI TIẾT SẢN PHẨM<M></M> </h2>
			<?php 
			if (isset($san_pham4)) {
				foreach ($san_pham4 as $sp) { ?>
					<div class="product-detail">
						<div class="product-image">
							<img src="image_SP/<?php echo htmlspecialchars($sp["hinh"]); ?>" alt="<?php echo htmlspecialchars($sp["ten_sp"]); ?>" />
						</div>
						<div class="product-info">
							<p style="font-weight:bold;">Tên: <?php echo htmlspecialchars($sp['ten_sp']); ?></p>
							<p><?php echo htmlspecialchars($sp['nd_tom_tat']);?></p>
							<p>Khuyến mãi: <?php echo htmlspecialchars($sp['khuyen_mai']);?></p>
							<p>Mô tả kỹ thuật: <?php echo htmlspecialchars($sp['nd_chi_tiet']);?></p>
							<p>Giá Bán: <?php echo number_format($sp['don_gia'], 0, ',', '.') . " VNĐ"; ?></p>
							<form class="form-inline" method="POST" action="ShowCart.php">
								<div class="form-group mb-2">
									<input type="hidden" name="maSP" value="<?php echo htmlspecialchars($sp['ma_sp'])?>">
									<input type="hidden" name="tenSP" value="<?php echo htmlspecialchars($sp['ten_sp'])?>">
									<input type="hidden" name="hinh" value="<?php echo htmlspecialchars($sp['hinh'])?>">
									<input type="hidden" name="donGia" value="<?php echo htmlspecialchars($sp['don_gia'])?>">
									<input type="number" name="sl" id="productQty" class="form-control" placeholder="Quantity" min="1" max="1000" value="1" size="7">
									<button type="submit" class="btn btn-primary" name="add_to_cart" value="add to cart">CHO VÀO GIỎ</button>
								</div>
							</form>
						</div>
					</div>
			<?php }
			} ?>
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
</foot
    ><!-- end footer -->
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