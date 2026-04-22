
# BTLShop - Laravel Book Store Project

## Giới thiệu
BTLShop là một dự án website bán sách truyện tranh được xây dựng bằng Laravel. Dự án hỗ trợ các chức năng quản lý sản phẩm, đơn hàng, người dùng, phân quyền quản trị viên, và các tính năng thương mại điện tử cơ bản.

## Tính năng chính
- Quản lý sản phẩm (CRUD sách, tác giả, nhà cung cấp, danh mục...)
- Quản lý đơn hàng, trạng thái đơn hàng
- Quản lý người dùng, phân quyền
- Tìm kiếm, lọc sản phẩm
- Đăng nhập/Đăng ký người dùng
- Quản lý slider, banner quảng cáo
- Thống kê doanh thu

## Công nghệ sử dụng
- Laravel Framework
- MySQL
- Bootstrap, Blade Template
- jQuery, JavaScript

## Cài đặt
1. Clone repository về máy:
	```bash
	git clone <repo-url>
	```
2. Cài đặt các package PHP:
	```bash
	composer install
	```
3. Cài đặt các package JS:
	```bash
	npm install
	```
4. Tạo file `.env` và cấu hình database:
	```bash
	cp .env.example .env
	# Sửa thông tin DB trong .env
	```
5. Tạo key ứng dụng:
	```bash
	php artisan key:generate
	```
6. Chạy migration và seed dữ liệu mẫu (nếu có):
	```bash
	php artisan migrate --seed
	```
7. Khởi động server:
	```bash
	php artisan serve
	```

## Thư mục chính
- `app/Models`: Các model Eloquent
- `resources/views`: Giao diện Blade
- `routes/web.php`: Định tuyến web
- `public/`: Thư mục public truy cập

## Đóng góp
Mọi đóng góp đều được hoan nghênh! Hãy tạo pull request hoặc issue nếu bạn có ý tưởng hoặc phát hiện lỗi.

## Tác giả
- Nhóm BTLShop - 2026
