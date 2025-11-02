<?php
// === 1. KHỞI TẠO PHIÊN & KIỂM TRA ĐĂNG NHẬP ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Vui lòng đăng nhập trước.'); window.location.href='../../index.php';</script>";
    exit;
}

// === 2. NHÚNG FORM THÊM NHÂN VIÊN ===
include(__DIR__ . "/../Form/formChen.php");
