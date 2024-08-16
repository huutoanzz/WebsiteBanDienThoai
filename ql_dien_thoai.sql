-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2024 lúc 10:51 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_dien_thoai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id` int(11) NOT NULL,
  `ma_hoa_don` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `so_luong` int(50) NOT NULL,
  `don_gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`id`, `ma_hoa_don`, `ma_sp`, `so_luong`, `don_gia`) VALUES
(5, 5, 13, 2, 10000000),
(6, 6, 3, 2, 37960000),
(8, 8, 8, 1, 9000000),
(9, 9, 7, 3, 29650000),
(10, 10, 4, 1, 13000000),
(36, 101, 2, 1, 27990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hoa_don` int(11) NOT NULL,
  `ma_khach_hang` int(11) NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` double NOT NULL,
  `tien_dat_coc` double NOT NULL,
  `con_lai` double NOT NULL,
  `hinh_thuc_thanh_toan` varchar(100) NOT NULL,
  `trang_thai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hoa_don`, `ma_khach_hang`, `ngay_dat`, `tong_tien`, `tien_dat_coc`, `con_lai`, `hinh_thuc_thanh_toan`, `trang_thai`) VALUES
(5, 2, '2018-03-01', 5000000, 0, 0, 'Tiền mặt', 'Đã xử lý'),
(6, 2, '2018-02-14', 2000000, 0, 0, 'Chuyển Khoản', 'Đã giao'),
(8, 3, '2018-03-03', 25000000, 0, 0, 'Tiền Mặt', 'Đã hủy'),
(9, 4, '2018-02-01', 15000000, 0, 0, 'Tiền Mặt', 'Đã giao'),
(10, 5, '2018-01-01', 30000000, 0, 0, 'Tiền Mặt', ''),
(11, 5, '2018-02-27', 5000000, 0, 0, 'Tiền Mặt', ''),
(12, 6, '2018-02-15', 7500000, 0, 0, 'Tiền Mặt', ''),
(13, 6, '2018-03-02', 2500000, 0, 0, 'Tiền mặt', ''),
(14, 4, '2018-02-01', 15000000, 0, 0, 'Tiền Mặt', ''),
(15, 5, '2018-01-01', 30000000, 0, 0, 'Tiền Mặt', ''),
(16, 5, '2018-02-27', 5000000, 0, 0, 'Tiền Mặt', ''),
(17, 6, '2018-02-15', 7500000, 0, 0, 'Tiền Mặt', ''),
(18, 6, '2018-03-02', 2500000, 0, 0, 'Tiền mặt', ''),
(19, 9, '2018-03-06', 10000000, 0, 0, 'Tiền mặt', ''),
(20, 9, '2018-02-20', 5000000, 0, 0, 'Tiền mặt', ''),
(21, 10, '2018-02-05', 15000000, 0, 0, 'Tiền mặt', ''),
(101, 43, '2024-06-06', 27990000, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_khach_hang` int(11) NOT NULL,
  `ten_khach_hang` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `hinh` varchar(100) NOT NULL,
  `ghi_chu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`ma_khach_hang`, `ten_khach_hang`, `email`, `dia_chi`, `dien_thoai`, `hinh`, `ghi_chu`) VALUES
(1, 'Nguyễn Hải Yến', 'yennh@cntp.edu.vn', '140 Lê Trọng Tấn', '08364785', 'H1.jpg', ''),
(2, 'Trương Thị Khánh Uyên', 'uyenttk@gmail.com', '123 Lê Trọng Tấn', '090756489', 'H2.jpg', ''),
(3, 'Nguyễn Văn Hòa', 'hoanv@gmail.com', '123 Cầu Xéo', '08987654', 'H3.jpg', ''),
(4, 'Ngô Thị Nguyệt', 'nguyetnt@gmail.com', '456 Tân kỳ tân quý', '086532148', 'H4.jpg', ''),
(5, 'Đinh Duy Minh', 'minhdd@gmail.com', '698 Đỗ thừa Luông', '01235478', 'H5.jpg', ''),
(6, 'Nguyễn Chinh Tây', 'taync@gmail.com', '546 Dương Văn Dương\r\n', '12345678', 'H6.jpg', ''),
(7, 'Nguyễn Việt Thu', 'thunv@gmail.com', '457 Đỗ Thừa Luông', '090123456', 'H7.jpg', ''),
(8, 'Nguyễn Linh Giang', 'giangnl@gmail.com', '1254 Gò Dầu', '093568745', 'H8.jpg', ''),
(9, 'Trương Thị Thu Hiền', 'hienttt@gmail.com', '54 Lương Thế Vinh', '01234587', 'H9.jpg', ''),
(10, 'Trương Thị Thanh Xuân', 'xuanttt@gmail.com', '99 Trường Chinh', '0124897333', 'H10.jpg', ''),
(43, 'Thân Nguyên Khánh Anh', 'toanphan799@gmail.com', '1234 Đường ABC', '03156494513', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `ma_loai` int(11) NOT NULL,
  `ten_loai` varchar(100) NOT NULL,
  `mo_ta` varchar(500) NOT NULL,
  `hinh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`ma_loai`, `ten_loai`, `mo_ta`, `hinh`) VALUES
(1, 'Apple', 'Ngoại hình tinh tế, luôn cập nhật mẫu mã mới', 'Apl0.jpg'),
(2, 'Samsung', 'Ngoại hình sang trọng, tinh tế', 'Sam0.jpg'),
(3, 'Asus', 'Ngoại hình mạnh mẽ, hiện đại', 'Opp0.jpg'),
(4, 'Xiaomi', 'Ngoại hình năng động, mới mẻ', 'Xiao0.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `ma_sp` int(11) NOT NULL,
  `ma_loai` int(11) NOT NULL,
  `ten_sp` varchar(100) NOT NULL,
  `nd_tom_tat` varchar(200) NOT NULL,
  `nd_chi_tiet` varchar(500) NOT NULL,
  `don_gia` double NOT NULL,
  `don_gia_khuyen_mai` double NOT NULL,
  `khuyen_mai` varchar(100) NOT NULL,
  `hinh` varchar(100) NOT NULL,
  `dvt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`ma_sp`, `ma_loai`, `ten_sp`, `nd_tom_tat`, `nd_chi_tiet`, `don_gia`, `don_gia_khuyen_mai`, `khuyen_mai`, `hinh`, `dvt`) VALUES
(1, 1, 'Iphone 15 promax 256GB', 'MÀU SẮC: WHITE TITANIUM', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: OLED Super Retina XDR\r\n- Camera sau: 48MP, 12MP\r\n- Camera trước: 12MP', 29590000, 0, 'Sạc dự phòng, bộ sạc', 'ip1.jpg', 'Chiếc'),
(2, 1, 'Iphone 14', 'MÀU SẮC: PINK', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: OLED Super Retina XDR\r\n- Camera sau: 48MP, 12MP', 27990000, 0, 'Sạc dự phòng, bộ sạc\r\n', 'ip2.jpg', 'Chiếc'),
(3, 1, 'Iphone 13 promax', 'MÀU SẮC: BLUE TITANIUM', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: OLED Super Retina XDR\r\n- Camera sau: 48MP, 12MP', 18990000, 0, 'Sạc dự phòng, bộ sạc\r\n', 'ip3.jpg', 'Chiếc'),
(4, 1, 'Iphone 12 promax 128GB', 'MÀU SẮC: NATURAL TITANIUM', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: OLED Super Retina XDR\r\n- Camera sau: 48MP, 12MP', 38990000, 0, 'Bộ sạc, tai nghe', 'ip4.jpg', 'Chiếc'),
(5, 2, 'Điện thoại Samsung Galaxy Z Fold 5 512GB ', 'MÀU SẮC: PHANTOM BLACK', '- Màn hình: - Chính 7.6\" & Phụ 6.2\"\r\n- Dynamic AMOLED 2X\r\n- Camera sau: 50MP, 12MP, 10MP\r\n- Camera trước: 10MP, 4MP\r\n- CPU: Snapdragon 8 Gen 2', 44990000, 0, 'Giảm thêm đến 350.000đ dành cho Học sinh - sinh viên', 'sam1.jpg', 'Chiếc'),
(6, 2, 'Điện thoại Samsung Galaxy Z Flip 5 512GB', 'MÀU SẮC: GRAPHITE', '- Màn hình: - Chính 6.7\" & Phụ 3.4\"\r\n- Chính: Dynamic AMOLED, Phụ: Super AMOLED\r\n- Camera sau: 2 x 12MP\r\n- Camera trước: 10MP\r\n- CPU: Snapdragon 8 Gen 2', 16990000, 0, 'Giảm thêm đến 1.000.000đ khi thanh toán bằng VNPAY-QR', 'sam2.jpg', 'Chiếc'),
(7, 2, 'Điện thoại Samsung Galaxy A35 5G 8GB/128GB ', 'MÀU SẮC: AWESOME BLUE', '- Camera sau: 50MP, 8MP, 5MP\r\n- Camera trước: 13MP\r\n- CPU: Exynos 1380\r\n- Bộ nhớ: 128GB', 8290000, 0, 'Nhập mã ZLPPV giảm thêm đến 200.000đ khi thanh toán qua ZaloPay', 'sam3.jpg', 'Chiếc'),
(8, 2, 'Điện thoại Samsung Galaxy A05 ', 'MÀU SẮC: SILVER', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: 6.7\" PLS LCD\r\n- Camera sau: 50MP, 2MP\r\n- Camera trước: 8MP', 3090000, 0, 'Giảm thêm đến 350.000đ dành cho Học sinh - sinh viên ', 'sam4.jpg', 'Chiếc'),
(9, 3, 'ASUS ROG Phone 5S', 'Hàng đã qua sửa chữa - Thay Main', 'Sản phẩm như mới\r\n- Đầy đủ phụ kiện\r\n- SN: ***356147313620212\r\n-  Bảo hành của hãng đến: 06/06/2023', 7990000, 0, 'Giảm thêm đến 350.000đ dành cho Học sinh - sinh viên', 'asus1.jpg', 'Chiếc'),
(10, 3, 'Điện thoại ASUS ROG Phone 7 16GB/512GB', 'MÀU SẮC: PHANTOM BLACK', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Màn hình: 6.78\" AMOLED Corning Gorilla Glass\r\n- Camera sau: 50MP, 13MP, 5MP\r\n- Camera trước: 32MP\r\n- CPU: Snapdragon 8 Gen 2', 27900000, 0, 'Bộ sạc, tai nghe, loa không dây bluetooth', 'asus2.jpg', 'Chiếc'),
(11, 3, 'ASUS ROG Phone 6', 'MÀU SẮC: STORM WHITE', '- CPU: Qualcomm Snapdragon 8+ Gen 1\r\n- Bộ nhớ: 256GB\r\n- RAM: 12GB\r\n- Hệ điều hành: Android', 50490000, 0, 'tay cầm trò chơi, bộ tai nghe', 'asus3.jpg', 'Chiếc'),
(12, 3, 'Điện thoại ASUS ROG Phone 7 Ultimate 16GB/512GB', 'MÀU SẮC: STORM WHITE', '- Màn hình: 6.78\" AMOLED. Corning Gorilla Glass\r\n- Camera sau: 50MP, 13MP, 5MP\r\n- Camera trước: 32MP\r\n- CPU: Snapdragon 8 Gen 2\r\n', 29990000, 0, 'Bộ tai nghe', 'asus4.jpg', 'Chiếc'),
(13, 4, 'Điện thoại Xiaomi Redmi 12C 128GB', 'MÀU SẮC: SPACE GRAY', '- Camera sau: 50MP\r\n- Camera trước: 5MP\r\n- CPU: MediaTek Helio G85', 3990000, 0, 'Tặng kèm bộ sạc', 'xiao1.jpg', 'Chiếc'),
(14, 4, 'Điện thoại di động Xiaomi Redmi 13C 6GB/128GB', 'MÀU SẮC: XANH DƯƠNG', '- Chính hãng, Mới 100%, Nguyên seal\r\n- Bộ nhớ: 128GB', 8250000, 0, 'Tặng kèm bộ sạc', 'redmi-13c-den.jpg', 'Chiếc'),
(33, 2, 'ToanPro2', 'ko co gi het', '', 20000000, 0, '', 'ip4.jpg', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `TenDN` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `TenDN`, `MatKhau`, `Email`, `Role`) VALUES
(3, 'admin', '2', 'admin@example.com', 1),
(6, 'toandeptrai', '123', 'toanphan799@gmail.com', 0),
(8, 'khanhanh', '123456', 'khanhanh.thannguyen@gmail.com', 0),
(10, 'huutoan', '123', 'htoan@gmail.com', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_hoa_don_ibfk_1` (`ma_sp`),
  ADD KEY `ma_hoa_don` (`ma_hoa_don`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hoa_don`),
  ADD KEY `hoa_don_ibfk_1` (`ma_khach_hang`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Chỉ mục cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`ma_loai`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`ma_sp`),
  ADD KEY `ma_loai` (`ma_loai`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  MODIFY `ma_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_1` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_2` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don` (`ma_hoa_don`);

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`ma_loai`) REFERENCES `loai_san_pham` (`ma_loai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
