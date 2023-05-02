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

        $this->createTables();
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

    private function createTables()
    {
        $table_name = "clientes";

        // Define as colunas da tabela
        $columns = array(
            "id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
            "email VARCHAR(255) NOT NULL UNIQUE KEY",
            "senha VARCHAR(60) NOT NULL",
            "razao_social VARCHAR(255) NOT NULL",
            "cnpj VARCHAR(14) NOT NULL UNIQUE KEY",
            "nome VARCHAR(255) NOT NULL",
            "token VARCHAR(32) NOT NULL",
            "verificado BOOLEAN NOT NULL DEFAULT FALSE",
            "criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMp"
        );

        // Cria a tabela no banco de dados
        $sql_create_table = "CREATE TABLE IF NOT EXISTS $table_name (" . implode(",", $columns) . ")";
        if ($this->conn->query($sql_create_table) === FALSE) {
            die("Erro ao criar tabela: " . $this->conn->error . "\n");
        }
    }
}