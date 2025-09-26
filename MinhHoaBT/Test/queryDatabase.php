<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

use LDAP\Result;

        $servername = "127.0.0.1";
        $username = "root"; 
        $password = "";
        $database = "DULIEU";
        $port = 3307;
        $link = mysqli_connect($servername, $username, $password, $database, $port);
        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
            echo "Connected successfully<br>";
        }

        mysqli_select_db($link, $database);
        $sql = "SELECT * FROM table1";
        $result = mysqli_query($link, $sql);
        
        echo "<table border='1' width = '100%'>";
        echo "<caption>Du lieu truy xuat tu bang nhan su</caption>";
        echo "<tr><th>Maso</th><th>Hoten</th><th>Ngaysinh</th><th>Nghenghiep</th></tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['Maso']."</td>";
            echo "<td>".$row['Hoten']."</td>";
            echo "<td>".$row['Ngaysinh']."</td>";
            echo "<td>".$row['Nghenghiep']."</td>";
            echo "</tr>";
        }        
        echo "</table>";
        mysqli_free_result($result);
        mysqli_close($link);
    ?>
</body>
</html>