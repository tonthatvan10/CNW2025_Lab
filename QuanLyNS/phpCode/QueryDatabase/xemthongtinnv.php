<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        require_once("../DB/connectDatabase.php");

        mysqli_select_db($link, $database);
        $sql = "SELECT * FROM nhanvien";
        $result = mysqli_query($link, $sql);

        echo "<table border='1' width = '100%'>";
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
        // mysqli_close($link);

    ?>
</body>
</html>