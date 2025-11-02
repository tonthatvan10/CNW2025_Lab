<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Bạn cần đăng nhập để thực hiện thao tác này.'); window.location.href='../../index.php';</script>";
    exit;
}

require_once(__DIR__ . "/../../DB/connectDatabase.php");

// Kiểm tra dữ liệu POST
if (empty($_POST['selected_nv']) || !is_array($_POST['selected_nv'])) {
    echo "<script>alert('Không có nhân viên nào được chọn.'); window.location.href='../../index.php?view=ql_nv';</script>";
    exit;
}

$ids = array_map('intval', $_POST['selected_nv']);
$idList = implode(',', $ids);

// Thực hiện xóa
$sql = "DELETE FROM nhanvien WHERE IDNV IN ($idList)";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Đã xóa " . count($ids) . " nhân viên thành công!'); window.location.href='../../index.php?view=ql_nv';</script>";
} else {
    echo "<script>alert('Lỗi khi xóa nhân viên: " . addslashes(mysqli_error($conn)) . "'); window.location.href='../../index.php?view=ql_nv';</script>";
}
?>
