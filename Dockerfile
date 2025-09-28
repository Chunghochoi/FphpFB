# Sử dụng image chính thức của PHP 8.2 với máy chủ Apache
FROM php:8.2-apache

# Cập nhật danh sách gói, cài đặt các extension PHP, và bật mod_rewrite trong MỘT bước
RUN apt-get update && docker-php-ext-install pdo pdo_mysql gd && a2enmod rewrite

# Sao chép toàn bộ mã nguồn của bạn vào thư mục web của Apache
COPY . /var/www/html/

# Cấp quyền ghi cho thư mục (giữ nguyên)
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
