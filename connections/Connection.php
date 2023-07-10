<?php
require_once './vendor/autoload.php';

use Dotenv\Dotenv;


class Connection
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->load();

        $this->conn = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE']
        );

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    public function close()
    {
        $this->conn->close();
        self::$instance = null;
    }

    public function __destruct()
    {
        $this->close();
    }


}