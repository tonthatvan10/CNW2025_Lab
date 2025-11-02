<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h3>Tìm kiếm</h3>
        <form action="" method="post">
            <input type="radio" name="timkiem" value="IDNV">
            <label for="IDNV">IDVN</label>

            <input type="radio" name="timkiem" value="Hoten">
            <label for="Hoten">Hoten</label>

            <input type="radio" name="timkiem" value="Diachi">
            <label for="Diachi">Diachi</label>
            <input type="text" name="noidung" id="" required>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    require_once(__DIR__ . "/../DB/connectDatabase.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $field = $_POST['timkiem'];
        $noidung = mysqli_real_escape_string($conn, $_POST['noidung']);

        $sql = "SELECT * FROM nhanvien WHERE $field LIKE '%$noidung%'";
        $result = mysqli_query($conn, $sql);
        echo "<table border='1' width='100%'>";
        echo "<caption>Danh sách nhân viên</caption>";
        echo "<tr><th>IDNV</th><th>Hoten</th><th>IDPB</th><th>Diachi</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['IDNV']."</td>";
            echo "<td>".$row['Hoten']."</td>";
            echo "<td>".$row['IDPB']."</td>";
            echo "<td>".$row['Diachi']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    }
    // mysqli_close($conn);
?>
</body>
</html>