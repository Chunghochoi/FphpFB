<?php
session_start(); // Đảm bảo đây là dòng ĐẦU TIÊN, không có bất kỳ ký tự nào trước nó.
require_once 'files/config.php';

// Kiểm tra đăng nhập (đã có trong config.php, nhưng để ở đây vẫn an toàn)
if (!isset($_SESSION['username'])) {
    header("Location: /auth.php");
    exit();
}
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
    <title>Trang Chủ</title>
</head>

<body class="bg-gray-100">

    <?php require_once 'files/components/header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800">Chào mừng, <?=$user_new['username']?>!</h1>
            <p class="mt-2 text-gray-600">Số dư của bạn là: <?=number_format($user_new['cash'])?> VNĐ</p>
        </div>
    </div>

    <?php require_once 'files/components/footer.php'; ?>

</body>
</html>
