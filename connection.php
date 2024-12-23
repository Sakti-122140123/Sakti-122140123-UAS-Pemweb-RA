<?php
/**
 * Class Database untuk mengelola koneksi database
 * Menggunakan pattern Singleton untuk memastikan hanya ada satu koneksi
 */
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = ""; 
    private $database = "lomba_17agustus";
    private $conn;
    private static $instance = null;

    /**
     * Constructor - membuat koneksi database
     */
    private function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    /**
     * Get instance database (Singleton pattern)
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get database connection
     */
    public function getConnection() {
        return $this->conn;
    }

    /**
     * Close database connection
     */
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}