<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $servername = "127.0.0.1";
        $username = "root"; 
        $password = "";
        $database = "testing";
        $port = 3307;

        $link = mysqli_connect($servername, $username, $password, $database, $port);
        if(!$link){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }

        echo "Kết nối thành công";
        $link->close();
    ?> 
</body>
</html>