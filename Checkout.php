<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    
<div class="container">
    <h1 class="mt-5 mb-4 text-center">THÔNG TIN ĐƠN HÀNG</h1>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <!-- Cart Items -->
                    <h4 class="mb-4">Giỏ hàng</h4>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <ul class="list-group mb-3">
                            <?php
                            $total = 0;
                            foreach($_SESSION['cart'] as $cartItem) {
                                $subtotal = $cartItem['sl'] * $cartItem['donGia'];
                                $total += $subtotal;
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-0"><?php echo $cartItem['tenSP']; ?></h6>
                                    <small class="text-muted">Số lượng: <?php echo $cartItem['sl']; ?> X Giá: <?php echo number_format($cartItem['donGia'], 0, ',', '.'); ?> VND</small>
                                </div>
                                <span class="text-muted"><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</span>
                            </li>
                            <?php } ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>Tổng cộng (VND)</strong></span>
                                <strong><?php echo number_format($total, 0, ',', '.'); ?> VND</strong>
                            </li>
                        </ul>
                    <?php else: ?>
                        <p>Giỏ hàng của bạn trống.</p>
                    <?php endif; ?>

                    <!-- Checkout Form -->
                    <form method="POST" action="<?php echo isset($_POST['submit']) ? 'ThongBaoHD.php' : ''; ?>">
                        <h4 class="mb-4">Địa chỉ đơn hàng</h4>
                        <div class="form-group">
                            <label for="fullName">Họ và tên</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Họ và tên" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Đường ABC" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="0932345678" required>
                        </div>
                         
                        <?php foreach ($_SESSION['cart'] as $cartItem) { ?>
                            <input type="hidden" name="maSP[]" value="<?php echo $cartItem['maSP']; ?>">
                        <?php } ?>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Tiếp tục thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>