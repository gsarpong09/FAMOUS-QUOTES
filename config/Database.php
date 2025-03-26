<?php
class Database {
    private $host = "dpg-cvhceb8gph6c73fkckt0-a.oregon-postgres.render.com";
    private $db_name = "quotesdb_yzyj";
    private $username = "root";
    private $password = "2Hx2LpWsVu1BswtbkxAiwgVFljZbEyTQ";
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $dsn = "pgsql:host={$this->host};port=5432;dbname={$this->db_name};";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo json_encode(["message" => "Connection error: " . $e->getMessage()]);
        }
        return $this->conn;
    }
}
