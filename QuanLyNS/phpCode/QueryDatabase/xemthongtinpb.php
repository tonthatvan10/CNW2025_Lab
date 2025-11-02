<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once(__DIR__ . "/../DB/connectDatabase.php");
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // mysqli_select_db($conn, $database);
        $sql = "SELECT * FROM phongban";
        $result = mysqli_query($conn, $sql);

        $phongban = []; // Mảng lưu IDPB

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $phongban[] = $row;
            }
            mysqli_free_result($result);
        } else {
            // Ghi log lỗi nếu cần
            error_log("Lỗi truy vấn phongban: " . mysqli_error($conn));
        }

        echo "<table border='1' width='100%'>";
        echo "<caption>Danh sách phòng ban</caption>";
        echo "<tr><th>IDPB</th><th>Tên phòng ban</th><th>Mô tả</th><th>Xem nhân viên</th></tr>";

        foreach ($phongban as $row) {
            echo "<tr>";
            echo "<td>{$row['IDPB']}</td>";
            echo "<td>{$row['Tenpb']}</td>";
            echo "<td>{$row['Mota']}</td>";
            echo "<td class='p-2 text-center'>
                    <a href='index.php?view=nvpb&IDPB={$row['IDPB']}' 
                       class='text-blue-600 hover:underline'>XXX</a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
        // mysqli_close($conn);

    ?>
</body>
</html>