<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// === KẾT NỐI CSDL ===
require_once(__DIR__ . "/../../DB/connectDatabase.php");

// === CHỈ XỬ LÝ KHI GỬI DỮ LIỆU BẰNG POST ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $tenNV   = trim($_POST['tenNV']);
    $diaChi  = trim($_POST['diaChi']);
    $phongBan = trim($_POST['phongBan']);

    // Kiểm tra dữ liệu hợp lệ
    if (!empty($tenNV) && !empty($diaChi) && !empty($phongBan)) {
        // Chuẩn bị câu lệnh INSERT (IDNV là AUTO_INCREMENT nên bỏ qua)
        $stmt = $conn->prepare("INSERT INTO NhanVien (Hoten, Diachi, IDPB) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tenNV, $diaChi, $phongBan);

        if ($stmt->execute()) {
            $_SESSION['message'] = "✅ Thêm nhân viên thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "❌ Lỗi khi thêm nhân viên: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "⚠️ Vui lòng nhập đầy đủ thông tin.";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "⚠️ Truy cập không hợp lệ.";
    $_SESSION['message_type'] = "error";
}

// === CHUYỂN HƯỚNG LẠI TRANG QUẢN LÝ NHÂN VIÊN ===
header("Location: ../../index.php?view=ql_nv");
exit;
