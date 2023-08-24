<?php
require_once './models/UserControl.php';

class UserControlDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function create(UserControl $userControl): UserControl
    {
        $query = "INSERT INTO user_control (email, senha, nome) 
                  VALUES (?, ?, ?)";

        $stmt = $this->db->getConn()->prepare($query);
        $email = $userControl->getEmail();
        $senha = $userControl->getSenha();
        $nome = $userControl->getNome();

        $stmt->bind_param("sss", $email, $senha, $nome);
        $stmt->execute();

        $userControl->setId($stmt->insert_id);

        return $userControl;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM user_control";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $userControls = [];
        while ($data = $result->fetch_assoc()) {
            $userControl = new UserControl();
            $userControl->setId($data['id_user_control'])
                ->setEmail($data['email'])
                ->setSenhaHashed($data['senha'])
                ->setNome($data['nome']);
            $userControls[] = $userControl;
        }
        return $userControls;
    }

    public function findById(int $id): UserControl
    {
        $sql = "SELECT * FROM user_control WHERE id_user_control = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
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
        $sql = "SELECT * FROM user_control WHERE email = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $data = $result->fetch_assoc();
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
        var_dump($userControl->getSenha());
        if ($userControl === null) {
            return false;
        }
        if (!password_verify($senha, $userControl->getSenha())) {
            return false;
        }
        return true;
    }
}