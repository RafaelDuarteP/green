<?php

require_once './connections/TesteDAO.php';
require_once './models/Equipamento.php';
require_once './models/TipoEquipamento.php';

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
        $sql = "SELECT * FROM equipamento WHERE id_equipamento = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
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
        $sql = "INSERT INTO equipamento (nome, descricao, tipo, id_pedido) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->getConn()->prepare($sql);
        $nome = $equipamento->getNome();
        $descricao = $equipamento->getDescricao();
        $stmt->bind_param('sssi', $nome, $descricao, $tipo, $idPedido);
        $stmt->execute();

        $equipamento->setId($stmt->insert_id);

        $testeDao = new TesteDAO();

        foreach ($equipamento->getTestes() as $teste) {
            $sql = "INSERT INTO equipamento_teste (id_equipamento, id_teste, status) VALUES (?, ?, 'EM_ANDAMENTO')";
            $stmt = $this->db->getConn()->prepare($sql);
            $idEquipamento = $equipamento->getId();
            $idTeste = $teste->getId();
            $stmt->bind_param('ii', $idEquipamento, $idTeste);
            $stmt->execute();
        }

        return $equipamento;
    }

    public function findAll(): array
    {
        $testeDao = new TesteDAO();
        $sql = "SELECT tipo, id_equipamento, nome, descricao FROM equipamento";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $equipamentos = [];
        foreach ($data as $equipamento) {
            switch ($equipamento[0]) {
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
                ->setId($equipamento[1])
                ->setNome($equipamento[2])
                ->setDescricao($equipamento[3])
                ->setTipo($tipo)
                ->setTestes($testeDao->findByEquipamento($equipamento[1]));
        }

        return $equipamentos;
    }

    public function findByPedido(int $id): array
    {
        $testeDao = new TesteDAO();
        $sql = "SELECT tipo, id_equipamento, nome, descricao FROM equipamento WHERE id_pedido = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $equipamentos = [];

        foreach ($data as $equipamento) {
            switch ($equipamento[0]) {
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
                ->setId($equipamento[1])
                ->setNome($equipamento[2])
                ->setDescricao($equipamento[3])
                ->setTipo($tipo)
                ->setTestes($testeDao->findByEquipamento($equipamento[1]));
        }

        return $equipamentos;
    }

    public function addTeste(int $idEquipamento, int $idTeste): bool
    {
        $sql = "INSERT INTO equipamento_teste (id_equipamento, id_teste, status) VALUES (?, ?, 'EM_ANDAMENTO')";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('ii', $idEquipamento, $idTeste);
        return $stmt->execute();
    }
}