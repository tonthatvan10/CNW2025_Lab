<?php
require_once(__DIR__ . "/../../DB/connectDatabase.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDPB = trim($_POST['IDPB']);
    $Tenpb = isset($_POST['Tenpb']) ? trim($_POST['Tenpb']) : '';
    $Mota = isset($_POST['Mota']) ? trim($_POST['Mota']) : '';

    if (empty($IDPB)) {
        echo "<script>alert('Vui lòng nhập IDPB!'); history.back();</script>";
        exit;
    }

    // === KIỂM TRA XEM IDPB ĐÃ TỒN TẠI CHƯA ===
    $check = $conn->prepare("SELECT Tenpb, Mota FROM PHONGBAN WHERE IDPB = ?");
    $check->bind_param("s", $IDPB);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // === NẾU TỒN TẠI: CẬP NHẬT ===
        $row = $result->fetch_assoc();

        // Giữ nguyên giá trị cũ nếu form để trống
        $Tenpb_final = !empty($Tenpb) ? $Tenpb : $row['Tenpb'];
        $Mota_final  = !empty($Mota) ? $Mota : $row['Mota'];

        $stmt = $conn->prepare("UPDATE PHONGBAN SET Tenpb = ?, Mota = ? WHERE IDPB = ?");
        $stmt->bind_param("sss", $Tenpb_final, $Mota_final, $IDPB);

        if ($stmt->execute()) {
            echo "<script>alert('Đã cập nhật phòng ban thành công!'); window.location.href='../../index.php?view=ql_pb';</script>";
            $stmt->close();
            $check->close();
            $conn->close();
            exit;
        } else {
            echo "<script>alert('Lỗi khi cập nhật phòng ban: " . addslashes($stmt->error) . "'); history.back();</script>";
            $stmt->close();
            $check->close();
            $conn->close();
            exit;
        }

    } else {
        // === NẾU CHƯA CÓ: THÊM MỚI ===
        if (empty($Tenpb)) {
            echo "<script>alert('Phòng ban mới cần có Tên phòng ban!'); history.back();</script>";
            $check->close();
            $conn->close();
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO PHONGBAN (IDPB, Tenpb, Mota) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $IDPB, $Tenpb, $Mota);

        if ($stmt->execute()) {
            echo "<script>alert('Đã thêm mới phòng ban!'); window.location.href='../../index.php?view=ql_pb';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm phòng ban: " . addslashes($stmt->error) . "'); history.back();</script>";
        }

        $stmt->close();
        $check->close();
        $conn->close();
        exit;
    }
}
?>
