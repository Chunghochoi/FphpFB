<?php
// Bật hiển thị lỗi để dễ dàng gỡ rối (bạn có thể tắt nó sau này)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nạp thư viện Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Nạp thư viện database
require_once 'libs/db.php';

// --- KẾT NỐI DATABASE ---
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Tạo chuỗi kết nối DSN đúng chuẩn cho PostgreSQL
if ($host && $user && $password && $dbname) {
    DB::$dsn = "pgsql:host=$host;dbname=$dbname";
    DB::$user = $user;
    DB::$password = $password;
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
