<?php
// === 1. KHỞI TẠO PHIÊN VÀ KIỂM TRA ĐĂNG NHẬP ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Vui lòng đăng nhập trước.'); window.location.href='../../index.php';</script>";
    exit;
}

require_once(__DIR__ . "/../../DB/connectDatabase.php");

// === 2. KIỂM TRA ID NHÂN VIÊN ===
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Thiếu hoặc sai mã nhân viên cần cập nhật.'); window.location.href='../../index.php?view=ql_nv';</script>";
    exit;
}

$idNV = intval($_GET['id']);

// === 3. LẤY THÔNG TIN NHÂN VIÊN ===
$stmt = $conn->prepare("SELECT IDNV, Hoten, Diachi, IDPB FROM NhanVien WHERE IDNV = ?");
$stmt->bind_param("i", $idNV);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Không tìm thấy nhân viên có ID $idNV'); window.location.href='../../index.php?view=ql_nv';</script>";
    exit;
}

$nhanvien = $result->fetch_assoc();
$stmt->close();

// === 4. HIỂN THỊ FORM CẬP NHẬT ===
include(__DIR__ . "/../Form/formCapnhatNV.php");
