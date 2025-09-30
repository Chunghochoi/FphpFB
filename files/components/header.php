<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between py-3">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-gray-800">
                    <img src="<?=$webinfo['logo_url']?>" alt="Logo" class="h-10">
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/" class="text-gray-600 hover:text-indigo-600 transition-colors">Trang Chủ</a>
                
                <?php if (isset($user_new)): ?>
                
                    <a href="/payment.php" class="text-gray-600 hover:text-indigo-600 transition-colors">Nạp Tiền</a>
                    
                    <?php if ($user_new['level'] == 1): ?>
                        <a href="/admin" class="text-red-500 hover:text-red-700 font-semibold transition-colors">Trang Admin</a>
                    <?php endif; ?>

                    <div class="flex items-center space-x-2 text-sm text-gray-700">
                        <span>Chào, <strong><?=$user_new['username']?></strong></span>
                        <span class="font-semibold text-green-600">(<?=number_format($user_new['cash'])?>đ)</span>
                    </div>
                    
                    <a href="/logout.php" class="text-gray-600 hover:text-indigo-600 transition-colors" title="Đăng Xuất">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="hidden md:inline">Đăng Xuất</span>
                    </a>

                <?php else: ?>
                    <a href="/auth.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium">Đăng Nhập</a>
                    <a href="/register.php" class="text-gray-600 hover:text-indigo-600 transition-colors">Đăng Ký</a>

                <?php endif; ?>
                </div>
        </nav>
    </div>
</header>
