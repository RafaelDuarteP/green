<?php

class TesteDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): Teste
    {
        $sql = "SELECT * FROM teste WHERE id = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_assoc();
        $teste = new Teste();
        $teste->setId($data['id_teste'])
            ->setDescricao($data['descricao'])
            ->setValor($data['valor']);
        return $teste;
    }

    public function create(Teste $teste): Teste
    {
        $sql = "INSERT INTO teste (descricao, valor) VALUES (:descricao, :valor)";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':descricao', $teste->getDescricao());
        $stmt->bindValue(':valor', $teste->getValor());
        $stmt->execute();

        return $teste->setId($stmt->insert_id);
    }

    public function update(Teste $teste): bool
    {
        $sql = "UPDATE teste SET descricao = :descricao, valor = :valor WHERE id_teste = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $teste->getId());
        $stmt->bindValue(':descricao', $teste->getDescricao());
        $stmt->bindValue(':valor', $teste->getValor());
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM teste WHERE id_teste = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM teste";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $testes = [];
        foreach ($data as $item) {
            $teste = new Teste();
            $teste->setId($item['id_teste'])
                ->setDescricao($item['descricao'])
                ->setValor($item['valor']);
            $testes[] = $teste;
        }
        return $testes;
    }


    public function findByEquipamento(int $id): array
    {
        $sql = "SELECT teste.id_teste, teste.valor, teste.descricao, equipamento_teste.status FROM teste JOIN equipamento_teste ON teste.id_teste = equipamento_teste.id_teste WHERE equipamento_teste.id_equipamento = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $testes = [];
        foreach ($data as $item) {
            switch ($item['status']) {
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
            $teste->setId($item['id_teste'])
                ->setStatus($status)
                ->setDescricao($item['descricao'])
                ->setValor($item['valor']);
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
        $sql = "UPDATE equipamento_teste SET status = :status WHERE id_equipamento = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':status', $status);
        return $stmt->execute();
    }

}