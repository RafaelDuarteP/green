<?php

class EquipamentoDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): Equipamento
    {
        $testeDao = new TesteDAO();
        $sql = "SELECT * FROM equipamento WHERE id_equipamento = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_assoc();
        switch ($data['tipo']) {
            case "COLETOR":
                $tipo = TipoEquipamentoEnum::COLETOR;
                break;
            case "MODULO":
                $tipo = TipoEquipamentoEnum::MODULO;
                break;
            case "RESERVATORIO":
                $tipo = TipoEquipamentoEnum::RESERVATORIO;
                break;
        }
        $equipamento = new Equipamento();
        $equipamento->setId($data['id_equipamento'])
            ->setNome($data['nome'])
            ->setDescricao($data['descricao'])
            ->setTipo($tipo)
            ->setTestes($testeDao->findByEquipamento($data['id_equipamento']));
        return $equipamento;
    }

    public function create(Equipamento $equipamento, int $idPedido): Equipamento
    {
        switch ($equipamento->getTipo()) {
            case TipoEquipamentoEnum::COLETOR:
                $tipo = "COLETOR";
                break;
            case TipoEquipamentoEnum::MODULO:
                $tipo = "MODULO";
                break;
            case TipoEquipamentoEnum::RESERVATORIO:
                $tipo = "RESERVATORIO";
                break;
        }
        $sql = "INSERT INTO equipamento (nome, descricao, tipo, id_pedido) VALUES (:nome, :descricao, :tipo, :id_pedido)";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':nome', $equipamento->getNome());
        $stmt->bindValue(':descricao', $equipamento->getDescricao());
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':id_pedido', $idPedido);
        $stmt->execute();

        $equipamento->setId($stmt->insert_id);

        $testeDao = new TesteDAO();

        foreach ($equipamento->getTestes() as $teste) {
            $teste = $testeDao->create($teste);
            $sql = "INSERT INTO equipamento_teste (id_equipamento, id_teste, status) VALUES (:id_equipamento, :id_teste, 'EM_ANDAMENTO')";
            $stmt = $this->db->getConn()->prepare($sql);
            $stmt->bindValue(':id_equipamento', $equipamento->getId());
            $stmt->bindValue(':id_teste', $teste->getId());
            $stmt->execute();
        }

        return $equipamento;
    }

    public function findAll(): array
    {
        $testeDao = new TesteDAO();
        $sql = "SELECT * FROM equipamento";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $equipamentos = [];
        foreach ($data as $equipamento) {
            switch ($equipamento['tipo']) {
                case "COLETOR":
                    $tipo = TipoEquipamentoEnum::COLETOR;
                    break;
                case "MODULO":
                    $tipo = TipoEquipamentoEnum::MODULO;
                    break;
                case "RESERVATORIO":
                    $tipo = TipoEquipamentoEnum::RESERVATORIO;
                    break;
            }
            $equipamentos[] = (new Equipamento())
                ->setId($equipamento['id_equipamento'])
                ->setNome($equipamento['nome'])
                ->setDescricao($equipamento['descricao'])
                ->setTipo($tipo)
                ->setTestes($testeDao->findByEquipamento($equipamento['id_equipamento']));
        }
        return $equipamentos;
    }

    public function findByPedido(int $id): array
    {
        $testeDao = new TesteDAO();
        $sql = "SELECT * FROM equipamento WHERE id_pedido = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $equipamentos = [];
        foreach ($data as $equipamento) {
            switch ($equipamento['tipo']) {
                case "COLETOR":
                    $tipo = TipoEquipamentoEnum::COLETOR;
                    break;
                case "MODULO":
                    $tipo = TipoEquipamentoEnum::MODULO;
                    break;
                case "RESERVATORIO":
                    $tipo = TipoEquipamentoEnum::RESERVATORIO;
                    break;
            }
            $equipamentos[] = (new Equipamento())
                ->setId($equipamento['id_equipamento'])
                ->setNome($equipamento['nome'])
                ->setDescricao($equipamento['descricao'])
                ->setTipo($tipo)
                ->setTestes($testeDao->findByEquipamento($equipamento['id_equipamento']));
        }
        return $equipamentos;
    }
}