<?php
session_start();
require_once '../files/config.php'; // Đường dẫn đã được điều chỉnh cho phù hợp

// --- PHẦN SỬA LỖI ---
// Giữ lại tinh túy bằng cách thêm lớp bảo vệ ở đầu file.

// 1. Kiểm tra người dùng đã đăng nhập chưa.
if (!isset($_SESSION['username'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập.
    header("Location: /auth.php");
    exit();
}

// 2. Sau khi chắc chắn đã đăng nhập, kiểm tra xem có phải Admin không.
// (Giả sử admin có level = 1, bạn có thể thay đổi số này nếu cần).
if ($user_new['level'] != 1) {
    // Nếu không phải admin, chuyển hướng về trang chủ.
    header("Location: /");
    exit();
}
// --- KẾT THÚC PHẦN SỬA LỖI ---

?>
<!DOCTYPE html>
<html lang="vi" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/assets/js/tailwind.config.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?=time()?>">
    <title>Trang Quản Trị</title>
</head>

<body class="bg-gray-100">

    <?php require_once '../files/components/header.php'; // Đường dẫn đã được điều chỉnh ?>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800">Chào mừng Admin, <?=$user_new['username']?>!</h1>
            <p class="mt-2 text-gray-600">Đây là khu vực quản trị.</p>
        </div>
    </div>

    <?php require_once '../files/components/footer.php'; // Đường dẫn đã được điều chỉnh ?>

</body>
</html>
