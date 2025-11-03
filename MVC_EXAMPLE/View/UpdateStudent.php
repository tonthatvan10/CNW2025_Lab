<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sinh viên</title>
</head>
<body>
    <h2>Cập nhật thông tin sinh viên</h2>

    <form method="post" action="?action=update&ID=<?php echo $student->ID; ?>">
        <label>Mã sinh viên (ID):</label><br>
        <!-- ID khóa chính, chỉ hiển thị, không cho sửa -->
        <input type="text" name="ID" value="<?php echo htmlspecialchars($student->ID); ?>" readonly><br><br>

        <label>Tên sinh viên:</label><br>
        <input type="text" name="NAME" value="<?php echo htmlspecialchars($student->NAME); ?>" required><br><br>

        <label>Tuổi:</label><br>
        <input type="number" name="AGE" value="<?php echo htmlspecialchars($student->AGE); ?>" required><br><br>

        <label>Trường đại học:</label><br>
        <input type="text" name="UNIVERSITY" value="<?php echo htmlspecialchars($student->UNIVERSITY); ?>" required><br><br>

        <button type="submit">Lưu thay đổi</button>
    </form>

    <br>
    <a href="index.php">⬅ Quay lại danh sách sinh viên</a>
</body>
</html>
