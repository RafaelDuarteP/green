<?php

require_once './models/Teste.php';
require_once './models/StatusTeste.php';

class TesteDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): Teste
    {
        $sql = "SELECT * FROM teste WHERE id = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $teste = new Teste();
        $teste->setId($data['id_teste'])
            ->setDescricao($data['descricao'])
            ->setValor($data['valor']);
        return $teste;
    }

    public function create(Teste $teste): Teste
    {
        $sql = "INSERT INTO teste (descricao, valor) VALUES (?, ?)";
        $stmt = $this->db->getConn()->prepare($sql);
        $descricao = $teste->getDescricao();
        $valor = $teste->getValor();
        $stmt->bind_param('ss', $descricao, $valor);
        $stmt->execute();

        return $teste->setId($stmt->insert_id);
    }

    public function update(Teste $teste): bool
    {
        $sql = "UPDATE teste SET descricao = ?, valor = ? WHERE id_teste = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $descricao = $teste->getDescricao();
        $valor = $teste->getValor();
        $id = $teste->getId();
        $stmt->bind_param('ssi', $descricao, $valor, $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM teste WHERE id_teste = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function findAll(): array
    {
        $sql = "SELECT id_teste, descricao, valor FROM teste";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $testes = [];
        foreach ($data as $item) {
            $teste = new Teste();
            $teste->setId($item[0])
                ->setDescricao($item[1])
                ->setValor($item[2]);
            $testes[] = $teste;
        }

        return $testes;
    }


    public function findByEquipamento(int $id): array
    {
        $sql = "SELECT teste.id_teste, teste.valor, teste.descricao, equipamento_teste.status, equipamento_teste.atualizado_em FROM teste JOIN equipamento_teste ON teste.id_teste = equipamento_teste.id_teste WHERE equipamento_teste.id_equipamento = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $testes = [];

        foreach ($data as $item) {
            switch ($item[3]) {
                case "EM_ANDAMENTO":
                    $status = StatusTesteEnum::EM_ANDAMENTO;
                    break;
                case "FINALIZADO":
                    $status = StatusTesteEnum::FINALIZADO;
                    break;
                default:
                    $status = StatusTesteEnum::EM_ANDAMENTO;
                    break;
            }
            $teste = new Teste();
            $teste->setId($item[0])
                ->setStatus($status)
                ->setDescricao($item[2])
                ->setValor($item[1])
                ->setData($item[4]);
            $testes[] = $teste;
        }

        return $testes;
    }

    public function updateStatus(int $id, int $status): bool
    {
        switch ($status) {
            case StatusTesteEnum::EM_ANDAMENTO:
                $status = "EM_ANDAMENTO";
                break;
            case StatusTesteEnum::FINALIZADO:
                $status = "FINALIZADO";
                break;
            default:
                $status = "EM_ANDAMENTO";
                break;
        }
        $sql = "UPDATE equipamento_teste SET status = ? WHERE id_equipamento = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }

}