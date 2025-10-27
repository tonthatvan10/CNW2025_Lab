<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="" method=""></form>
    </div>

    <?php
        require("../QueryDatabase/xemthongtinnv.php");
        require("../QueryDatabase/xemthongtinpb.php");
    ?>
    <div>
        <h2>Thêm nhân viên mới</h2>
        <form action="capnhatNV.php" method="post">
            <label>Họ tên:</label>
            <input type="text" name="Hoten" required><br><br>

            <label>Địa chỉ:</label>
            <input type="text" name="Diachi" required><br><br>

            <label>IDPB:</label>
            <input type="text" name="IDPB" required><br><br>

            <input type="submit" value="Thêm nhân viên">
    </form>
    </div>
    
</body>
</html>