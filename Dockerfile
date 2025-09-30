# Sử dụng image chính thức của PHP 8.2 với máy chủ Apache
FROM php:8.2-apache

# Cài đặt các thư viện hệ thống cần thiết (cho postgresql) và các công cụ khác
RUN apt-get update && apt-get install -y \
    git \
    zip \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Cài đặt Composer (trình quản lý gói cho PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www/html

# Sao chép các tệp composer.json và composer.lock trước
COPY composer*.json ./

# Chạy composer install để tải về các thư viện cần thiết
RUN composer install --no-dev --optimize-autoloader

# Sao chép toàn bộ mã nguồn còn lại của bạn vào
COPY . .

# Cài đặt các extension PHP cần thiết và bật mod_rewrite
RUN docker-php-ext-install pdo pdo_pgsql gd && a2enmod rewrite

# --- PHẦN SỬA LỖI QUAN TRỌNG ---
# Cấp quyền cho thư mục session mặc định của PHP
RUN chown -R www-data:www-data /var/lib/php/sessions

# Cấp quyền cho thư mục mã nguồn
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
