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
    <title>Trang chủ</title>
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/botui/0.3.10/botui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/botui/0.3.10/botui-theme-default.css" rel="stylesheet">
	<style>
		.carousel-item img {
			width: 100%;
			height: auto;
		}
		.dd_sp {
			width: 32%;
			float: left;
			margin: 5px;
			overflow: hidden;
			border: 1px solid #ddd;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		.dd_sp h3 {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.modal-dialog {
        max-width: 500px;
        margin: 30px auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-title {
        font-size: 1.5rem;
        margin: 0;
    }

    .close {
        color: #fff;
        opacity: 1;
        border: none;
        background: none;
        font-size: 1.5rem;
    }

    .close:hover, .close:focus {
        color: #ffc107;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-body {
        padding: 20px;
        height: 400px;
        overflow-y: auto;
        background-color: #fff;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        box-shadow: inset 0 -4px 8px rgba(0, 0, 0, 0.1);
    }

    .botui-container {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .botui-message {
        background-color: #007bff;
        color: #fff;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
        max-width: 80%;
        align-self: flex-start;
    }

    .botui-user {
        background-color: #f1f1f1;
        color: #333;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
        max-width: 80%;
        align-self: flex-end;
    }

    .botui-action-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .botui-action-button:hover {
        background-color: #0056b3;
    }
    
	</style>
</head>
	
	<?php
		$pdo = new PDO("mysql:host=localhost;dbname=ql_dien_thoai","root","");
		$pdo->query("set names utf8");
		$sql = "SELECT * FROM san_pham LIMIT 6";
		$sanpham = $pdo->query($sql);
		$pdo = null;
	?>


<!-- body -->

<body class="main-layout ">
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
									 <li class="last">
										 <a href="#" data-toggle="modal" data-target="#chatbotModal"><i class="bi bi-chat-dots"></i></a>
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

    <!-- Pop-up giỏ hàng -->
	<!-- Liên kết trực tiếp đến trang giỏ hàng --

	<!-- Pop-up chatbot -->
	<div class="modal fade" id="chatbotModal" tabindex="-1" role="dialog" aria-labelledby="chatbotModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="chatbotModalLabel">Chatbot</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="botui-app">
						<bot-ui></bot-ui>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Các nội dung khác của trang -->
    <!-- about -->
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                    <div class="about_img">
                        <figure><img src="images/aboutt.jpg" alt="img" /></figure>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 co-sm-l2">
                    <div class="about_box">
                            <h3>Về chúng tôi</h3>
                            <span>Pomato Store</span>
                            <p>Chào mừng đến với cửa hàng trực tuyến của chúng tôi! Tại đây, chúng tôi tự hào mang đến cho bạn một bộ sưu tập đa dạng những chiếc điện thoại mới nhất với những ưu đãi hấp dẫn. Với sứ mệnh làm hài lòng mọi khách hàng, chúng tôi cam kết cung cấp những sản phẩm chất lượng, dịch vụ chăm sóc khách hàng tận tâm và trải nghiệm mua sắm trực tuyến an toàn, tiện lợi nhất. Hãy khám phá ngay để không bỏ lỡ cơ hội sở hữu chiếc điện thoại ưng ý của bạn! </p>
                        </div>
               
            </div>
        </div>
    </div>
    </div>
    <!-- end about -->

    <!-- brand -->
    <div class="brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Pomato Store</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="brand-bg">
            <div class="container">
                <div class="col-12">
                    <?php
                        foreach ($sanpham as $sp) {
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
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a href="brand.php" class="btn btn-danger btn-lg">Tất cả sản phẩm</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- end brand -->
    <!-- contact -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <br><br>
                        <h2>Liên hệ với chúng tôi</h2>
                    </div>
                    <form class="main_form">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input class="form-control" placeholder="Your name" type="text" name="Your Name">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input class="form-control" placeholder="Email" type="text" name="Email">
                            </div>
                            <div class=" col-md-12">
                                <input class="form-control" placeholder="Phone" type="text" name="Phone">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message"></textarea>
                            </div>
                            <div class=" col-md-12">
                                <button class="send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
    <div id="botui-app">
        <bot-ui></bot-ui>
    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/botui/build/botui.min.js"></script>
    <script>
    var botui = new BotUI('botui-app');

    // Bắt đầu trò chuyện
    botui.message.add({
        content: 'Xin chào! Tôi có thể giúp gì cho bạn?'
    }).then(function() {
        return botui.action.button({
            delay: 1000,
            action: [
                { text: 'Hỏi một câu hỏi', value: 'ask' },
                { text: 'Xem sản phẩm', value: 'view_products' },
                { text: 'Không cần, cảm ơn!', value: 'no' }
            ]
        });
    }).then(function(res) {
        if (res.value === 'ask') {
            askQuestion();
        } else if (res.value === 'view_products') {
            viewProducts();
        } else {
            endConversation();
        }
    });

    // Xử lý câu hỏi
    function askQuestion() {
        botui.message.add({
            delay: 1000,
            content: 'Vui lòng đặt câu hỏi của bạn.'
        }).then(function() {
            return botui.action.text({
                delay: 1000,
                action: {
                    placeholder: 'Nhập câu hỏi của bạn ở đây...'
                }
            });
        }).then(function(res) {
            var question = res.value;
            botui.message.add({
                delay: 1000,
                content: 'Cảm ơn bạn đã hỏi: "' + question + '". Bạn muốn tôi làm gì với câu hỏi này?'
            }).then(function() {
                return botui.action.button({
                    delay: 1000,
                    action: [
                        { text: 'Gửi câu hỏi', value: 'submit' },
                        { text: 'Hủy', value: 'cancel' }
                    ]
                });
            }).then(function(res) {
                if (res.value === 'submit') {
                    botui.message.add({
                        delay: 1000,
                        content: 'Câu hỏi của bạn đã được gửi. Chúng tôi sẽ trả lời bạn sớm nhất!'
                    });
                } else {
                    botui.message.add({
                        delay: 1000,
                        content: 'Đã hủy câu hỏi của bạn.'
                    });
                }
                showMainMenu();
            });
        });
    }

    // Xem sản phẩm
    function viewProducts() {
        botui.message.add({
            delay: 1000,
            content: 'Chúng tôi có những sản phẩm sau đây:'
        }).then(function() {
            return botui.action.button({
                delay: 1000,
                action: [
                    { text: 'Điện thoại 1', value: 'phone1' },
                    { text: 'Điện thoại 2', value: 'phone2' },
                    { text: 'Điện thoại 3', value: 'phone3' },
                    { text: 'Xem giỏ hàng', value: 'view_cart' },
                    { text: 'Quay lại', value: 'back' }
                ]
            });
        }).then(function(res) {
            if (res.value === 'phone1') {
                showProductDetails('Điện thoại 1', '10.000.000 VNĐ');
            } else if (res.value === 'phone2') {
                showProductDetails('Điện thoại 2', '15.000.000 VNĐ');
            } else if (res.value === 'phone3') {
                showProductDetails('Điện thoại 3', '20.000.000 VNĐ');
            } else if (res.value === 'view_cart') {
                window.location.href = 'showcart.html'; // Đổi URL tới trang giỏ hàng
            } else {
                showMainMenu();
            }
        });
    }

    // Hiển thị chi tiết sản phẩm
    function showProductDetails(productName, price) {
        botui.message.add({
            delay: 1000,
            content: 'Bạn đã chọn ' + productName + '. Giá: ' + price
        }).then(function() {
            showMainMenu();
        });
    }

    // Hiển thị menu chính
    function showMainMenu() {
        botui.message.add({
            delay: 1000,
            content: 'Bạn có muốn hỏi thêm gì không?'
        }).then(function() {
            return botui.action.button({
                delay: 1000,
                action: [
                    { text: 'Hỏi một câu hỏi', value: 'ask' },
                    { text: 'Xem sản phẩm', value: 'view_products' },
                    { text: 'Không cần, cảm ơn!', value: 'no' }
                ]
            });
        }).then(function(res) {
            if (res.value === 'ask') {
                askQuestion();
            } else if (res.value === 'view_products') {
                viewProducts();
            } else {
                endConversation();
            }
        });
    }

    // Kết thúc trò chuyện
    function endConversation() {
        botui.message.add({
            delay: 1000,
            content: 'Cảm ơn bạn đã ghé thăm. Hẹn gặp lại!'
        });
    }
</script>


</body>


</html>