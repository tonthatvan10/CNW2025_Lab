<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>Thêm sinh viên mới</h2>

    <form method="post" action="?action=add">
        <label>Mã sinh viên</label><br>
        <input type="text" name="ID" required><br><br>

        <label>Tên sinh viên:</label><br>
        <input type="text" name="NAME" required><br><br>

        <label>Tuổi:</label><br>
        <input type="number" name="AGE" required><br><br>

        <label>Trường đại học:</label><br>
        <input type="text" name="UNIVERSITY" required><br><br>

        <button type="submit">Thêm sinh viên</button>
    </form>

    <br>
    <a href="index.php">⬅ Quay lại danh sách</a>
</body>
</html>
