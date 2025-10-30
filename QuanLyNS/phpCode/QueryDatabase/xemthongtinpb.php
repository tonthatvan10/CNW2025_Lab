<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once("../DB/connectDatabase.php");


        mysqli_select_db($link, $database);
        $sql = "SELECT * FROM phongban";
        $result = mysqli_query($link, $sql);

        $phongban = []; // Mảng lưu IDPB

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $phongban[] = $row;
            }
            mysqli_free_result($result);
        } else {
            // Ghi log lỗi nếu cần
            error_log("Lỗi truy vấn phongban: " . mysqli_error($link));
        }

        echo "<table border='1' width = '100%'>";
        echo "<caption>Danh sách phong ban</caption>";
        echo "<tr><th>IDPB</th><th>Tenpb</th><th>Mota</th><th>Xem nhan vien</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['IDPB']."</td>";
            echo "<td>".$row['Tenpb']."</td>";
            echo "<td>".$row['Mota']."</td>";
            echo "<td><a href='xemthongtinnvpb.php?IDPB=".$row['IDPB']."'>XXX</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
        // mysqli_close($link);

    ?>
</body>
</html>