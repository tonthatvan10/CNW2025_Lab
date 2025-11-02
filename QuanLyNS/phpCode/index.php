<?php
ob_start(); // ✅ Bắt đầu buffer để đảm bảo header() hoạt động
// === 1. KHỞI ĐỘNG SESSION ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// === 2. KIỂM TRA ĐĂNG NHẬP ===
$isLoggedIn = isset($_SESSION['username']);
$username   = $isLoggedIn ? $_SESSION['username'] : '';

// === 3. XỬ LÝ ĐĂNG XUẤT ===
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// === 4. XÁC ĐỊNH NỘI DUNG HIỂN THỊ ===
$contentTitle = "Bảng điều khiển thống kê";
$contentFile  = null; // mặc định không hiển thị file nào

if (isset($_GET['view'])) {
    switch ($_GET['view']) {
        case 'nv':
            $contentTitle = "Xem Thông Tin Nhân Viên";
            $contentFile  = "QueryDatabase/xemthongtinnv.php";
            break;
        case 'pb':
            $contentTitle = "Xem Thông Tin Phòng Ban";
            $contentFile  = "QueryDatabase/xemthongtinpb.php";
            break;
        case 'timkiem':
            $contentTitle = "Tìm Kiếm Nhân Viên";
            $contentFile  = "QueryDatabase/timkiem.php";
            break;
        case 'ql_nv':
            if ($isLoggedIn) {
                $contentTitle = "Quản Lý Nhân Viên (Thêm/Sửa/Xóa)";
                $contentFile  = "UpdateDatabase/Feature/quanLyNhanVien.php";
            } else {
                $contentTitle = "Truy Cập Bị Từ Chối";
            }
            break;
        case 'ql_pb':
            if ($isLoggedIn) {
                $contentTitle = "Cập Nhật Phòng Ban";
                $contentFile  = "UpdateDatabase/Feature/capnhatPB.php";
            } else {
                $contentTitle = "Truy Cập Bị Từ Chối";
            }
            break;
        case 'nvpb':
            if (isset($_GET['IDPB']) && is_numeric($_GET['IDPB'])) {
                $contentTitle = "Nhân viên phòng ban ID: " . $_GET['IDPB'];
                $contentFile  = "QueryDatabase/xemthongtinnvpb.php";
            } else {
                $contentTitle = "Lỗi: ID phòng ban không hợp lệ";
                $contentFile  = null;
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Lý Nhân Sự</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body, #app { height: 100%; margin: 0; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
<div id="app" class="flex flex-col h-full">

    <!-- HEADER -->
    <header class="bg-blue-600 shadow-md text-white p-4 flex justify-between items-center z-10">
        <a href="index.php" class="text-2xl font-bold hover:text-yellow-300 transition">
            Hệ thống Quản lý
        </a>

        <nav class="flex items-center space-x-4">
            <?php if ($isLoggedIn): ?>
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-white hover:bg-blue-700 px-3 py-2 rounded-full transition">
                        <div class="w-8 h-8 bg-yellow-300 rounded-full flex items-center justify-center text-blue-800 font-bold text-sm shadow">
                            <?= strtoupper(substr($username, 0, 2)) ?>
                        </div>
                        <span class="text-sm font-medium"><?= htmlspecialchars($username) ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="index.php?action=logout" class="block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H5a3 3 0 01-3-3V7a3 3 0 013-3h5a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <a href="Login/login.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition shadow-md">
                    Đăng Nhập
                </a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- MAIN -->
    <main class="flex flex-1 overflow-hidden">
        <aside class="w-64 bg-white shadow-lg p-6 flex flex-col space-y-2 border-r border-gray-200">
            <a href="index.php" class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2 hover:text-blue-600 transition block">
                Menu
            </a>

            <a href="index.php?view=nv" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Xem NV Cơ Bản</span>
            </a>

            <a href="index.php?view=pb" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Xem Phòng Ban</span>
            </a>

            <a href="index.php?view=timkiem" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>Tìm Kiếm</span>
            </a>

            <?php if ($isLoggedIn): ?>
                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold text-blue-600 mb-4">Quản Lý</h3>
                    <a href="index.php?view=ql_nv" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-500 text-white hover:bg-blue-700 transition font-medium shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2m0 2v-4m-9 0h10M4 18h2v-2a3 3 0 013-3h10a3 3 0 013 3v2h2"></path>
                        </svg>
                        <span>Quản Lý Nhân Viên</span>
                    </a>
                    <a href="index.php?view=ql_pb" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-500 text-white hover:bg-indigo-700 transition font-medium shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M9 21V3m6 18V3"></path>
                        </svg>
                        <span>Quản Lý Phòng Ban</span>
                    </a>
                </div>
            <?php endif; ?>
        </aside>

        <section class="flex-1 p-8 overflow-y-auto">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
                    <?= htmlspecialchars($contentTitle) ?>
                </h2>

                <?php
                require_once(__DIR__ . "/DB/connectDatabase.php");

                if (isset($_GET['view']) && $contentFile) {
                    if (file_exists($contentFile)) {
                        require_once $contentFile;
                    } else {
                        echo "<div class='text-red-500 p-4 bg-red-50 rounded-lg'>
                                Lỗi: Không tìm thấy file: " . htmlspecialchars($contentFile) . "
                              </div>";
                    }
                } else {
                    $tong_nv = $conn->query("SELECT COUNT(*) AS tong_nv FROM NHANVIEN")->fetch_assoc()['tong_nv'] ?? 0;
                    $tong_pb = $conn->query("SELECT COUNT(*) AS tong_pb FROM PHONGBAN")->fetch_assoc()['tong_pb'] ?? 0;

                    echo "
                    <div class='grid grid-cols-1 md:grid-cols-2 gap-6'>
                        <div class=\"p-6 bg-blue-100 rounded-lg shadow hover:shadow-lg transition\">
                            <h3 class=\"text-lg font-semibold text-blue-800\">Tổng số nhân viên</h3>
                            <p class=\"text-4xl font-bold text-blue-600 mt-2\">$tong_nv</p>
                        </div>
                        <div class=\"p-6 bg-green-100 rounded-lg shadow hover:shadow-lg transition\">
                            <h3 class=\"text-lg font-semibold text-green-800\">Tổng số phòng ban</h3>
                            <p class=\"text-4xl font-bold text-green-600 mt-2\">$tong_pb</p>
                        </div>
                    </div>
                    <div class='mt-10 text-gray-600 text-sm'>
                        <p>Chào mừng bạn đến với hệ thống quản lý nhân sự.</p>
                        <p>Chọn chức năng ở menu bên trái để bắt đầu làm việc.</p>
                    </div>
                    ";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </main>
</div>
<?php ob_end_flush(); ?>
</body>
</html>
