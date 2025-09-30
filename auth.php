<?php
session_start();
require_once 'files/config.php';

// --- PHẦN SỬA LỖI ---
// Chỉ xử lý logic đăng nhập khi người dùng nhấn nút submit (phương thức POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem các trường username và password có rỗng hay không
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Kiểm tra thông tin đăng nhập với database
        $user = DB::queryFirstRow("SELECT * FROM users WHERE username=%s AND password=%s", $username, $password);

        if ($user) {
            // Nếu đúng, lưu session và chuyển hướng
            $_SESSION['username'] = $username;
            header("Location: /");
            exit(); // Dừng script sau khi chuyển hướng
        } else {
            // Nếu sai, tạo thông báo lỗi
            $error_message = thongbao('error', 'Tên đăng nhập hoặc mật khẩu không chính xác.');
        }
    } else {
        // Nếu người dùng không nhập đủ thông tin
        $error_message = thongbao('error', 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.');
    }
}
// --- KẾT THÚC PHẦN SỬA LỖI ---
?>
<!DOCTYPE html>
<html lang="vi" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <meta name="description" content="<?=$webinfo['site_description']?>">
    <meta name="keywords" content="<?=$webinfo['site_keywords']?>">
    <link rel="shortcut icon" href="<?=$webinfo['favicon_url']?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?=time()?>">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <div class="text-center mb-8">
                <img src="<?=$webinfo['logo_url']?>" alt="Logo" class="mx-auto h-12">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Đăng nhập tài khoản
                </h2>
            </div>
            
            <?php
            // Hiển thị thông báo lỗi nếu có
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
            
            <form class="space-y-6" action="/auth.php" method="POST">
                <div>
                    <label for="username" class="sr-only">Tên đăng nhập</label>
                    <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Tên đăng nhập">
                </div>
                <div>
                    <label for="password" class="sr-only">Mật khẩu</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Mật khẩu">
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="/register.php" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Chưa có tài khoản? Đăng ký
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
