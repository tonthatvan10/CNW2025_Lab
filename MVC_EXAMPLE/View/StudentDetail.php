<h2>Thông tin sinh viên</h2>
<form method="POST">
    <input type="hIDden" NAME="ID" value="<?= isset($student) ? $student->ID : '' ?>">
    Tên: <input type="text" NAME="NAME" value="<?= isset($student) ? $student->NAME : '' ?>"><br>
    Tuổi: <input type="number" NAME="AGE" value="<?= isset($student) ? $student->AGE : '' ?>"><br>
    Trường: <input type="text" NAME="UNIVERSITY" value="<?= isset($student) ? $student->UNIVERSITY : '' ?>"><br>
    <button type="submit">Lưu</button>
</form>
<a href="index.php">Quay lại</a>
