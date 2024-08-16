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
    <title>Sản phẩm</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<style>
		.dd_sp {
			width: 32%;
			border: 1px solid grey;
			float: left;
			margin: 5px;
			overflow: hidden;
		}

		.dd_sp h3 {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

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
		.clearfix {
			clear: both;
			text-align: center; 
			margin-top: 20px; 
			margin-bottom: 20px; 
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
	?>
	<?php
    include("Pager.php");

    $pdo_sp_phan_trang = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
    $pdo_sp_phan_trang->query("set names utf8");
    $sql_sp_phan_trang = "SELECT * FROM san_pham";
    $stmt = $pdo_sp_phan_trang->prepare($sql_sp_phan_trang);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        $san_pham_phan_trang = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Xử lý phân trang
    $p = new Pager();
    $limit = 6;
    $count = count($san_pham_phan_trang);
    $vt = $p->findStart($limit);
    $pages = $p->findPages($count, $limit);
    
    $cur = $_GET["page"];
    $phan_trang = $p->pageList($cur, $pages);
    
    $sql_sp_phan_trang = "SELECT * FROM san_pham LIMIT $vt, $limit";
    $stmt = $pdo_sp_phan_trang->prepare($sql_sp_phan_trang);
    $stmt->execute();
    $san_pham_phan_trang = $stmt->fetchAll(PDO::FETCH_OBJ); 
    
    $pdo_sp_phan_trang = null;
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
			<?php
			// Hiển thị sản phẩm theo từng trường hợp
			if (isset($_GET['ml']) && isset($_GET['tl'])) {
				echo "<h2 style='text-align: center;'><b>" . htmlspecialchars($_GET['tl']) . "</b></h2>";
				if ($san_pham->rowCount() > 0) {
					foreach ($san_pham as $sp) {
						?>
						<a href="Detail.php?id=<?php echo htmlspecialchars($sp["ma_sp"]); ?>" style="text-decoration: none; color: black;">
							<div class="dd_sp" style="margin-bottom: 20px;">
								<img src="image_SP/<?php echo htmlspecialchars($sp["hinh"]); ?>" width="100%" height="170px" />
								<h3><?php echo htmlspecialchars($sp["ten_sp"]); ?></h3>
								<p>Đơn giá: <span style="color: #F00"><?php echo number_format($sp["don_gia"], 0, ',', '.') ?> VND</span></p>
							</div>
						</a>
			<?php
					}
				} else {
					echo "<p>Không có sản phẩm thuộc loại này.</p>";
				}
			} elseif (isset($_GET["txt_Search"])) {
				if ($san_pham2->rowCount() > 0) {
					$count = $san_pham2->rowCount();
					echo "<h2>Đã tìm thấy $count sản phẩm</h2>";
					foreach ($san_pham2 as $sp) {
						?>
						<a href="Detail.php?id=<?php echo htmlspecialchars($sp["ma_sp"]); ?>" style="text-decoration: none; color: black;">
							<div class="dd_sp" style="margin-bottom: 20px;">
								<img src="image_SP/<?php echo htmlspecialchars($sp["hinh"]); ?>" width="100%" height="170px" />
								<h3><?php echo htmlspecialchars($sp["ten_sp"]); ?></h3>
								<p>Đơn giá: <span style="color: #F00"><?php echo number_format($sp["don_gia"], 0, ',', '.') ?> VND</span></p>
							</div>
						</a>
			<?php
					}
				} else {
					echo "<h2>Không tìm thấy sản phẩm nào.</h2>";
				}
			} elseif (isset($_GET['gt']) && isset($_GET['gc'])) {
				$gt = (int)$_GET['gt'];
				$gc = (int)$_GET['gc'];
				echo "<h2>Sản phẩm trong khoảng giá " . number_format($gt) . "đ - " . number_format($gc) . "đ</h2>";
				if ($san_pham3->rowCount() > 0) {
					foreach ($san_pham3 as $sp) {
						?>
						<a href="Detail.php?id=<?php echo htmlspecialchars($sp["ma_sp"]); ?>" style="text-decoration: none; color: black;">
							<div class="dd_sp" style="margin-bottom: 20px;">
								<img src="image_SP/<?php echo htmlspecialchars($sp["hinh"]); ?>" width="100%" height="170px" />
								<h3><?php echo htmlspecialchars($sp["ten_sp"]); ?></h3>
								<p>Đơn giá: <span style="color: #F00"><?php echo number_format($sp["don_gia"], 0, ',', '.') ?> VND</span></p>
							</div>
						</a>
			<?php
					}
				} else {
					echo "<p>Không có sản phẩm nào trong khoảng giá này.</p>";
				}
			} elseif (isset($_GET['gt'])) {
				$gt = (int)$_GET['gt'];
				echo "<h2>Sản phẩm trên " . number_format($gt) . "đ</h2>";
				if ($san_pham3->rowCount() > 0) {
					foreach ($san_pham3 as $sp) {
						?>
						<a href="Detail.php?id=<?php echo htmlspecialchars($sp["ma_sp"]); ?>" style="text-decoration: none; color: black;">
							<div class="dd_sp" style="margin-bottom: 20px;">
								<img src="image_SP/<?php echo htmlspecialchars($sp["hinh"]); ?>" width="100%" height="170px" />
								<h3><?php echo htmlspecialchars($sp["ten_sp"]); ?></h3>
								<p>Đơn giá: <span style="color: #F00"><?php echo number_format($sp["don_gia"], 0, ',', '.') ?> VND</span></p>
							</div>
						</a>
			<?php
					}
				} else {
					echo "<p>Không có sản phẩm nào trong khoảng giá này.</p>";
				}
			} else {
				echo "<h2>Tất cả điện thoại</h2>";
				foreach ($san_pham_phan_trang as $sp) {
					?>
					<a href="Detail.php?id=<?php echo htmlspecialchars($sp->ma_sp); ?>" style="text-decoration: none; color: black;">
						<div class="dd_sp" style="margin-bottom: 20px;">
							<img src="image_SP/<?php echo htmlspecialchars($sp->hinh); ?>" width="100%" height="170px" />
							<h3><?php echo htmlspecialchars($sp->ten_sp); ?></h3>
							<p>Đơn giá: <span style="color: #F00"><?php echo number_format($sp->don_gia, 0, ',', '.') ?> VND</span></p>
						</div>
					</a>

			<?php
				}
				echo "<div class='clearfix'>";
				echo $phan_trang;
				echo "</div>";
			}
			?>
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
</footer><!-- end footer -->
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