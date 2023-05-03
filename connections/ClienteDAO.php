<?php

require_once 'Connection.php';
require_once './models/Cliente.php';

class ClienteDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function create(Cliente $cliente)
    {
        $query = "INSERT INTO clientes (email, senha, razao_social, cnpj, nome, token) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->getConn()->prepare($query);
        $email = $cliente->getEmail();
        $senha = $cliente->getSenha();
        $razao_social = $cliente->getRazaoSocial();
        $cnpj = $cliente->getCnpj();
        $nome = $cliente->getNome();
        $token = $cliente->getToken();

        $stmt->bind_param("ssssss", $email, $senha, $razao_social, $cnpj, $nome, $token);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function update(Cliente $cliente)
    {
        $query = "UPDATE clientes SET email = ?, senha = ?, razao_social = ?, cnpj = ?, nome = ? WHERE id = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $id = $cliente->getId();
        $email = $cliente->getEmail();
        $senha = $cliente->getSenha();
        $razao_social = $cliente->getRazaoSocial();
        $cnpj = $cliente->getCnpj();
        $nome = $cliente->getNome();

        $stmt->bind_param("sssssi", $email, $senha, $razao_social, $cnpj, $nome, $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function verifica(int $id)
    {
        $query = "UPDATE clientes SET verificado = TRUE WHERE id = ?";

        $stmt = $this->db->getConn()->prepare($query);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM clientes WHERE id = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function findById(int $id): ?Cliente
    {
        $query = "SELECT * FROM clientes WHERE id = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        $cliente = new Cliente();
        $cliente->setId($data['id'])
            ->setEmail($data['email'])
            ->setSenhaHashed($data['senha'])
            ->setRazaoSocial($data['razao_social'])
            ->setCnpj($data['cnpj'])
            ->setNome($data['nome'])
            ->setToken($data['token'])
            ->setVerificado($data['verificado']);

        return $cliente;
    }

    public function findByToken(string $token): int
    {
        $query = "SELECT id FROM clientes WHERE token = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return -1;
        }

        $data = $result->fetch_assoc();

        return $data['id'];
    }

    public function findByEmailOrCNPJ(string $key): ?Cliente
    {
        $query = "SELECT * FROM clientes WHERE email = ? OR cnpj = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("ss", $key, $key);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        $cliente = new Cliente();
        $cliente->setId($data['id'])
            ->setEmail($data['email'])
            ->setSenhaHashed($data['senha'])
            ->setRazaoSocial($data['razao_social'])
            ->setCnpj($data['cnpj'])
            ->setNome($data['nome'])
            ->setToken($data['token'])
            ->setVerificado($data['verificado']);

        return $cliente;

    }

    public function login(string $login, string $senha): bool
    {
        $cliente = $this->findByEmailOrCNPJ($login);
        echo $cliente->getSenha();
        if ($cliente && password_verify($senha, $cliente->getSenha())) {
            return true;
        } else {
            return false;
        }
    }

    public function exists(string $email, string $cnpj): bool
    {
        $cliente_email = $this->findByEmailOrCNPJ($email);
        $cliente_cnpj = $this->findByEmailOrCNPJ($cnpj);
        if (is_null($cliente_cnpj) or is_null($cliente_email))
            return true;
        return false;
    }

}