<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên theo phòng ban</title>
</head>
<body>
    <?php
        // SỬA ĐƯỜNG DẪN ĐÚNG
        require_once(__DIR__ . "/../DB/connectDatabase.php");

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // KIỂM TRA IDPB CÓ TỒN TẠI VÀ LÀ SỐ
        if (!isset($_GET['IDPB']) || !is_numeric($_GET['IDPB'])) {
            echo "<p class='text-red-500'>Lỗi: ID phòng ban không hợp lệ!</p>";
            exit;
        }

        $idpb = (int)$_GET['IDPB'];

        // DÙNG PREPARED STATEMENT → AN TOÀN + ĐÚNG CÚ PHÁP
        $sql = "SELECT IDNV, Hoten, Diachi FROM nhanvien WHERE IDPB = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idpb);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        echo "<table border='1' width='100%' class='table-auto'>";
        echo "<caption class='text-xl font-bold mb-4'>Danh sách nhân viên của phòng ban ID: " . htmlspecialchars($idpb) . "</caption>";
        echo "<tr class='bg-gray-200'>
                <th class='p-2'>IDNV</th>
                <th class='p-2'>Họ tên</th>
                <th class='p-2'>Địa chỉ</th>
              </tr>";

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='hover:bg-gray-50'>";
                echo "<td class='p-2 text-center'>{$row['IDNV']}</td>";
                echo "<td class='p-2'>{$row['Hoten']}</td>";
                echo "<td class='p-2'>{$row['Diachi']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' class='p-4 text-center text-gray-500'>Không có nhân viên nào.</td></tr>";
        }

        echo "</table>";

        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    ?>
</body>
</html>