<?php

class UserControlDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): UserControl
    {
        $sql = "SELECT * FROM user_control WHERE id_user_control = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_assoc();
        $userControl = new UserControl();
        $userControl->setId($data['id_user_control'])
            ->setEmail($data['email'])
            ->setSenhaHashed($data['senha'])
            ->setNome($data['nome']);
        return $userControl;
    }

    public function findByEmail(string $email): ?UserControl
    {
        $sql = "SELECT * FROM user_control WHERE email = :email";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $data = $stmt->fetch_assoc();
        if ($data === null) {
            return null;
        }
        $userControl = new UserControl();
        $userControl->setId($data['id_user_control'])
            ->setEmail($data['email'])
            ->setSenhaHashed($data['senha'])
            ->setNome($data['nome']);
        return $userControl;
    }

    public function login($email, $senha)
    {
        $userControl = $this->findByEmail($email);
        if ($userControl === null) {
            return false;
        }
        if (!password_verify($senha, $userControl->getSenha())) {
            return false;
        }
        return true;
    }
}