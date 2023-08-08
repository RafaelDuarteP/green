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
        $query = "INSERT INTO cliente (email, senha, razao_social, cnpj, nome, token) 
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
        $query = "UPDATE cliente SET email = ?, senha = ?, razao_social = ?, cnpj = ?, nome = ? WHERE id_cliente = ?";

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
        $query = "UPDATE cliente SET verificado = TRUE WHERE id_cliente = ?";

        $stmt = $this->db->getConn()->prepare($query);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM cliente WHERE id_cliente = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function findById(int $id): ?Cliente
    {
        $query = "SELECT * FROM cliente WHERE id_cliente = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        $cliente = new Cliente();
        $cliente->setId($data['id_cliente'])
            ->setEmail($data['email'])
            ->setSenhaHashed($data['senha'])
            ->setRazaoSocial($data['razao_social'])
            ->setCnpj($data['cnpj'])
            ->setNome($data['nome'])
            ->setToken($data['token'])
            ->setVerificado($data['verificado']);

        return $cliente;
    }

    public function findAll(): array
    {
        $query = "SELECT id_cliente, email, razao_social, cnpj, nome, verificado FROM cliente";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        $clientes = [];

        $data = $result->fetch_all();

        foreach ($data as $item) {
            $cliente = new Cliente();
            $cliente->setId($item[0])
                ->setEmail($item[1])
                ->setRazaoSocial($item[2])
                ->setCnpj($item[3])
                ->setNome($item[4])
                ->setVerificado($item[5]);

            $clientes[] = $cliente;
        }

        return $clientes;
    }

    public function findByToken(string $token): int
    {
        $query = "SELECT id_cliente FROM cliente WHERE token = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return -1;
        }

        $data = $result->fetch_assoc();

        return $data['id_cliente'];
    }

    public function findByEmailOrCNPJ(string $key): ?Cliente
    {
        $query = "SELECT * FROM cliente WHERE email = ? OR cnpj = ?";

        $stmt = $this->db->getConn()->prepare($query);
        $stmt->bind_param("ss", $key, $key);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
        $cliente = new Cliente();
        $cliente->setId($data['id_cliente'])
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
        if ($cliente && password_verify($senha, $cliente->getSenha())) {
            return true;
        } else {
            return false;
        }
    }

    public function exists(string $email, string $cnpj): bool
    {
        $exist = false;
        $cliente_email = $this->findByEmailOrCNPJ($email);
        $cliente_cnpj = $this->findByEmailOrCNPJ($cnpj);
        if (!is_null($cliente_cnpj))
            $exist = true;
        if (!is_null($cliente_email))
            $exist = true;
        return $exist;
    }

}