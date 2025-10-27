<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("../DB/connectDatabase.php");
        $Hoten = $_POST['Hoten'];
        $Diachi = $_POST['Diachi'];
        $IDPB = $_POST['IDPB'];

        $sql = "INSERT INTO nhanvien (Hoten, Diachi, IDPB) VALUES (?, ?, ?)";

        $stmt = $link->prepare($sql);
        $stmt->bind_param("ssi", $Hoten, $Diachi, $IDPB);

        if ($stmt->execute()) {
            echo "<script>alert('Thêm nhân viên thành công!'); window.location.href='chen.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm nhân viên!'); window.history.back();</script>";
        }
        
        $stmt->close();
        $link->close();
    ?>
</body>
</html>