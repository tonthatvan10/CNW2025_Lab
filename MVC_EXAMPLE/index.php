<?php
require_once("./Controller/C_Student.php");

$controller = new C_Student();

// Nếu chưa có action, mặc định là 'list' (xem danh sách)
$action = $_GET['action'] ?? 'list';

// Nếu người dùng submit form tìm kiếm (POST)
if ($action === 'search' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->invokeSearch();
} else {
    $controller->invoke($action);
}
?>
