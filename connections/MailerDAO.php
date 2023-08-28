<?php

require_once 'vendor/autoload.php';
use Dotenv\Dotenv;

class MailerDAO
{
    private $db;
    private $key;

    public function __construct()
    {
        $this->db = Connection::getInstance();
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->load();

        $this->key = $_ENV['MAILER_KEY'];
    }

    public function updateSenha(string $senha): bool
    {
        $encryptedSenha = openssl_encrypt($senha, 'AES-128-ECB', $this->key);
        $sql = "UPDATE mailer SET senha = ? WHERE id = 1";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('s', $encryptedSenha);
        return $stmt->execute();
    }

    public function getSenha(): string
    {
        $sql = "SELECT senha FROM mailer WHERE id = 1";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return openssl_decrypt($data['senha'], 'AES-128-ECB', $this->key);
    }
}