# Sử dụng image chính thức của PHP với máy chủ Apache
FROM php:8.0-apache

# Sao chép toàn bộ mã nguồn của bạn vào thư mục web của Apache
COPY . /var/www/html/

# Cài đặt các thư viện PHP cần thiết mà ứng dụng của bạn có thể dùng
# Ví dụ: pdo_mysql để kết nối cơ sở dữ liệu và gd để xử lý hình ảnh
RUN docker-php-ext-install pdo pdo_mysql gd

# Bật module rewrite của Apache để tệp .htaccess có thể hoạt động
RUN a2enmod rewrite

# Cấp quyền ghi cho thư mục để ứng dụng có thể tạo hoặc sửa đổi tệp (nếu cần)
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
