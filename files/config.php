<?php
// Bật hiển thị lỗi để dễ dàng gỡ rối
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nạp thư viện Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Nạp thư viện database
require_once 'libs/db.php';

// --- KẾT NỐI DATABASE (ĐÃ SỬA LỖI SSL CHO RENDER) ---

// Lấy chuỗi kết nối duy nhất từ biến môi trường của Render
$database_url = getenv('DATABASE_URL');

if ($database_url) {
    // Phân tích URL thành các thành phần
    $db_parts = parse_url($database_url);

    $host = $db_parts['host'];
    $port = $db_parts['port'];
    $dbname = ltrim($db_parts['path'], '/');
    $user = $db_parts['user'];
    $pass = $db_parts['pass'];

    // Quan trọng: Thêm "sslmode=require" vào chuỗi DSN để bật SSL
    DB::$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    // Gán các thông tin còn lại cho MeekroDB
    DB::$user = $user;
    DB::$password = $pass;
    
} else {
    // Dừng ứng dụng nếu không tìm thấy chuỗi kết nối
    die("Lỗi: Không tìm thấy biến môi trường DATABASE_URL.");
}
// --- KẾT THÚC KẾT NỐI DATABASE ---


// --- CÁC CÀI ĐẶT KHÁC ---
// Lấy thông tin website từ database
$webinfo = DB::queryFirstRow("SELECT * FROM settings WHERE id = 1");

// Hàm hiển thị thông báo
function thongbao($type, $text) {
    return '<div class="px-4 py-2 rounded-sm text-sm border bg-red-100 border-red-200 text-red-600 mb-4">' . $text . '</div>';
}

// Kiểm tra thông tin người dùng nếu đã đăng nhập
if (isset($_SESSION['username'])) {
    $user_new = DB::queryFirstRow("SELECT * FROM users WHERE username = %s", $_SESSION['username']);
}
?>
