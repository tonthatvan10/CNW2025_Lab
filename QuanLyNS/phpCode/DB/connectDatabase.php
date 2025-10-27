<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "dulieu";
$port = 3307;

$link = mysqli_connect($servername, $username, $password, $database, $port);

// Kiểm tra kết nối
if (!$link) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}