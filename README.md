# Website Bán Điện Thoại Di Động Pomato

## 📋 Mô tả dự án
Dự án xây dựng một website giúp người dùng dễ dàng mua sắm và quản lý các sản phẩm điện thoại di động. Giao diện thân thiện kết hợp với các chức năng quản lý chuyên nghiệp hỗ trợ tối ưu hóa trải nghiệm người dùng và quản trị viên.

## 👥 Thành viên nhóm
Số lượng thành viên: **01**

## 🛠 Công nghệ sử dụng
- **Front-end**: HTML5, CSS, Bootstrap, JavaScript
- **Back-end**: PHP
- **Database**: MySQL
- **Công cụ hỗ trợ**: 
  - **XAMPP**: Chạy server và quản lý database cục bộ.
  - **PHPMailer**: Gửi email xác nhận đơn hàng và thông báo tài khoản.

## ✨ Mô tả chức năng chính
1. **Quản lý giỏ hàng & đặt hàng**:
   - Thêm sản phẩm vào giỏ hàng.
   - Đặt hàng và thanh toán trực tuyến.

2. **Hệ thống quản lý & phân quyền**:
   - Quản trị viên có quyền quản lý sản phẩm, đơn hàng, và khách hàng.

3. **Chatbot hỗ trợ khách hàng**:
   - Tự động trả lời các câu hỏi và hỗ trợ tư vấn sản phẩm.

4. **Gửi email qua PHPMailer**:
   - Gửi email xác nhận đơn hàng và thông báo tài khoản cho người dùng.

5. **Trang sản phẩm**:
   - Hiển thị danh sách sản phẩm.
   - Hỗ trợ tìm kiếm và lọc sản phẩm theo danh mục, giá cả.

6. **Chi tiết sản phẩm**:
   - Hiển thị thông tin chi tiết sản phẩm, hình ảnh, và đánh giá.

7. **Tài khoản người dùng**:
   - Cho phép đăng ký, đăng nhập và quản lý thông tin cá nhân.

---

## 🛠 Hướng dẫn cài đặt

### Yêu cầu:
1. **XAMPP**: Cài đặt XAMPP để chạy server PHP và MySQL.
   - Tải xuống tại [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
2. Trình duyệt web (Chrome, Firefox, v.v.).
3. Text editor/IDE: Visual Studio Code hoặc Abode Dreamweaver.

---

### Các bước thực hiện:
# Hướng Dẫn Cài Đặt và Chạy Dự Án

## 1. Cài đặt XAMPP
- Tải và cài đặt **XAMPP** từ [Apache Friends](https://www.apachefriends.org/index.html).
- Sau khi cài đặt, mở **XAMPP Control Panel** và khởi động **Apache** và **MySQL**.

## 2. Cấu hình Database
- Mở trình duyệt và truy cập **phpMyAdmin** tại: `http://localhost/phpmyadmin`.
- Tạo một cơ sở dữ liệu mới với tên, ví dụ: `ql_dien_thoai`.
- Nếu có tệp SQL, thực hiện nhập dữ liệu:
  - Chuyển đến tab **Import**.
  - Chọn tệp `ql_dien_thoai.sql`.
  - Nhấn **Go** để hoàn tất nhập dữ liệu.

## 3. Đặt mã nguồn vào thư mục XAMPP
- Sao chép toàn bộ mã nguồn của dự án.
- Dán mã nguồn vào thư mục `htdocs` của XAMPP:
  ```
  C:/xampp/htdocs/WebsiteBanDienThoai/
  ```

## 4. Chạy dự án
- Mở trình duyệt và truy cập địa chỉ:
  ```
  http://localhost/WebsiteBanDienThoai
  ```
- Nếu mọi thứ được cấu hình đúng, giao diện website sẽ hiển thị.
