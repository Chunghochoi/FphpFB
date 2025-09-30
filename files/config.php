<?php
// Bỏ dòng session_start(); khỏi đây.

// Bật hiển thị lỗi để dễ dàng gỡ rối
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nạp thư viện Composer
require_once __DIR__ . '/../vendor/autoload.php';

// --- KẾT NỐI DATABASE ---
$database_url = getenv('DATABASE_URL');
if ($database_url) {
    $db_parts = parse_url($database_url);
    $host = $db_parts['host'];
    $port = $db_parts['port'];
    $dbname = ltrim($db_parts['path'], '/');
    $user = $db_parts['user'];
    $pass = $db_parts['pass'];

    DB::$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    DB::$user = $user;
    DB::$password = $pass;
} else {
    die("Lỗi: Không tìm thấy biến môi trường DATABASE_URL.");
}

// --- CÁC CÀI ĐẶT & BIẾN TOÀN CỤC ---
$webinfo = DB::queryFirstRow("SELECT * FROM settings WHERE id = 1");

// Chỉ truy vấn thông tin người dùng nếu họ đã đăng nhập
if (isset($_SESSION['username'])) {
    $user_new = DB::queryFirstRow("SELECT * FROM users WHERE username = %s", $_SESSION['username']);
}

// Hàm hiển thị thông báo
function thongbao($type, $text) {
    $base_class = 'px-4 py-2 rounded-sm text-sm border mb-4';
    if ($type === 'error') {
        return '<div class="' . $base_class . ' bg-red-100 border-red-200 text-red-600">' . htmlspecialchars($text) . '</div>';
    } else {
        return '<div class="' . $base_class . ' bg-green-100 border-green-200 text-green-600">' . htmlspecialchars($text) . '</div>';
    }
}
?>
