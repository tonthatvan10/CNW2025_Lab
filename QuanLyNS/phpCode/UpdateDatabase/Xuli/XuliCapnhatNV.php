<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../../DB/connectDatabase.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNV = (int)$_POST['idNV'];
    $tenNV = trim($_POST['tenNV']);
    $diaChi = trim($_POST['diaChi']);
    $phongBan = trim($_POST['phongBan']);

    if ($idNV > 0 && $tenNV && $diaChi && $phongBan) {
        $stmt = $conn->prepare("UPDATE NhanVien SET Hoten = ?, Diachi = ?, IDPB = ? WHERE IDNV = ?");
        $stmt->bind_param("sssi", $tenNV, $diaChi, $phongBan, $idNV);

        if ($stmt->execute()) {
            $_SESSION['message'] = "✅ Cập nhật nhân viên thành công!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "❌ Lỗi khi cập nhật: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "⚠️ Dữ liệu không hợp lệ, vui lòng nhập đầy đủ.";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "⚠️ Truy cập không hợp lệ.";
    $_SESSION['message_type'] = "error";
}

header("Location: ../../index.php?view=ql_nv");
exit;
