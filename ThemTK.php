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
$tb = "";

if (isset($_POST["btnSubmit"])) {
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];
    $email = $_POST["txtEmail"];
    $role = $_POST["txtRole"];

    // Insert user information into the database
    $sql = "INSERT INTO user (TenDN, MatKhau, Email, Role) VALUES (?, ?, ?, ?)";
    $param = array($username, $password, $email, $role);
    $sta = $pdo->prepare($sql);
    $kq = $sta->execute($param);
    if ($kq) {
        $tb = "Thêm tài khoản thành công";
    } else {
        $tb = "Thêm tài khoản không thành công";
    }
}
?>

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
                                        <li> <a href="TrangChu.php">Giới thiệu</a> </li>
                                        <li><a href="brand.php">Sản phẩm</a></li>
                                        <li><a href="DangKy.php">Đăng ký</a></li>
                                        <li><a href="DangNhap.php">Đăng nhập</a></li>
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
                <li class="list-group-item" style="background-color:black"><a href="#" style="text-transform:uppercase; text-decoration:none; color:white; font-weight:bold;">Chức năng</a></li>
                <li class='list-group-item bg-light'><a href="Admin.php">Quản lý sản phẩm</a></li>
                <li class='list-group-item bg-light'><a href="Admin_KH.php">Quản lý khách hàng</a></li>
                <li class='list-group-item bg-light'><a href="QLHD.php">Quản lý hóa đơn</a></li>
                <li class='list-group-item bg-light'><a href="AdminTK.php">Quản lý tài khoản</a></li>
            </ul>
        </div>
        <div class="col-9">
            <h2 align="center">THÊM TÀI KHOẢN</h2>
            <br /><br /><br />
            <form method="post" action="ThemTK.php">
                <div class="form-group">
                    <label>Tên tài khoản</label>
                    <input type="text" class="form-control" placeholder="Nhập tên tài khoản" name="txtUsername" id="idUsername" required="required" />
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="txtPassword" id="idPassword" required="required" />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Nhập email" name="txtEmail" id="idEmail" required="required" />
                </div>
                <div class="form-group">
                    <label>Vai trò</label>
                    <input type="text" class="form-control" placeholder="Nhập vai trò" name="txtRole" id="idRole" required="required" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnSubmit">Create</button>
                </div>
                <div class="text-danger">
                    <?php
                    if ($tb) {
                        echo $tb;
                    } else {
                        echo "";
                    }
                    ?>
                </div>
            </form>
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
