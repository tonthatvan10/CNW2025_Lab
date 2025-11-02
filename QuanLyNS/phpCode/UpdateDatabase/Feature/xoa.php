<?php
// === 1. KHỞI TẠO PHIÊN & KIỂM TRA ĐĂNG NHẬP ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<script>
        alert('Bạn cần đăng nhập để thực hiện thao tác này.');
        window.location.href='../../index.php';
    </script>";
    exit;
}

require_once(__DIR__ . "/../../DB/connectDatabase.php");

// === 2. LẤY ID NHÂN VIÊN CẦN XÓA ===
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        alert('ID nhân viên không hợp lệ.');
        window.location.href='../../index.php?view=ql_nv';
    </script>";
    exit;
}

$id = intval($_GET['id']);

// === 3. THỰC HIỆN XÓA ===
$stmt = $conn->prepare("DELETE FROM nhanvien WHERE IDNV = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// === 4. KIỂM TRA KẾT QUẢ ===
if ($stmt->affected_rows > 0) {
    echo "<script>
        alert('✅ Đã xóa nhân viên có ID $id thành công!');
        window.location.href='../../index.php?view=ql_nv';
    </script>";
} else {
    echo "<script>
        alert('⚠️ Không tìm thấy nhân viên để xóa.');
        window.location.href='../../index.php?view=ql_nv';
    </script>";
}

// === 5. DỌN DẸP ===
$stmt->close();
$conn->close();
?>
