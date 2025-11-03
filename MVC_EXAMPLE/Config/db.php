<?php
class Database {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "mvc_dulieu";
    private $port = 3307;
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $dsn = "mysql:host={$this->servername};port={$this->port};dbname={$this->database};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "✅ Kết nối thành công!";
        } catch (PDOException $e) {
            echo "❌ Kết nối thất bại: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
