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

        // Nhận dữ liệu từ form login
        $username = $_POST['textBox'] ?? '';
        $password = $_POST['password'] ?? '';

        function containsVietnamese($str)
        {
            $vietnameseChars = 'àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ
                                ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ';
            return preg_match('/[' . $vietnameseChars . ']/u', $str);
        }
        
        if (containsVietnamese($username)) {
            echo "<script>alert('Tên tài khoản không được chứa ký tự có dấu!'); window.history.back();</script>";
            exit;
        }
        if (containsVietnamese($password)) {
            echo "<script>alert('Mật khẩu không được chứa ký tự có dấu!'); window.history.back();</script>";
            exit;
        }

        // Lấy user theo username
        $stmt = $link->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $db_password = $user['password'];

            $hashed_input = strtoupper('*' . sha1(sha1($password, true)));

            if (hash_equals($hashed_input, $db_password)) {
                $_SESSION['username'] = $username;
                header("Location: ../index.php");
                exit;
            } else {
                echo "<script>alert('Sai mật khẩu!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Tài khoản không tồn tại!'); window.history.back();</script>";
            exit;
}

        $stmt->close();
        mysqli_close($link);
    ?>
</body>
</html>