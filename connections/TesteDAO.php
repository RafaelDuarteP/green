<?php

require_once './models/Teste.php';
require_once './models/StatusTeste.php';
require_once './models/TipoEquipamento.php';

class TesteDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): Teste
    {
        $sql = "SELECT * FROM teste WHERE id_teste = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        switch ($data['tipo_equipamento']) {
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
        $teste = new Teste();
        $teste->setId($data['id_teste'])
            ->setDescricao($data['descricao'])
            ->setValor($data['valor'])
            ->setNome($data['nome'])
            ->setTipoEquipamento($tipo);
        return $teste;
    }

    public function create(Teste $teste): Teste
    {
        switch ($teste->getTipoEquipamento()) {
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
        $sql = "INSERT INTO teste (descricao, valor, nome, tipo_equipamento) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->getConn()->prepare($sql);
        $nome = $teste->getNome();
        $descricao = $teste->getDescricao();
        $valor = $teste->getValor();
        $stmt->bind_param('ssss', $descricao, $valor, $nome, $tipo);
        $stmt->execute();

        return $teste->setId($stmt->insert_id);
    }

    public function update(Teste $teste): bool
    {
        $sql = "UPDATE teste SET descricao = ?, valor = ?, nome = ? WHERE id_teste = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $descricao = $teste->getDescricao();
        $valor = $teste->getValor();
        $nome = $teste->getNome();
        $id = $teste->getId();
        $stmt->bind_param('sssi', $descricao, $valor, $nome, $id);
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
        $sql = "SELECT id_teste, descricao, valor, nome, tipo_equipamento FROM teste";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $testes = [];
        foreach ($data as $item) {
            switch ($item[4]) {
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
            $teste = new Teste();
            $teste->setId($item[0])
                ->setDescricao($item[1])
                ->setValor($item[2])
                ->setNome($item[3])
                ->setTipoEquipamento($tipo);
            $testes[] = $teste;
        }

        return $testes;
    }

    public function findByEquipamento(int $id): array
    {
        $sql = "SELECT teste.id_teste, teste.valor, teste.descricao, equipamento_teste.status, equipamento_teste.atualizado_em, teste.nome, teste.tipo_equipamento FROM teste JOIN equipamento_teste ON teste.id_teste = equipamento_teste.id_teste WHERE equipamento_teste.id_equipamento = ? ORDER BY equipamento_teste.atualizado_em";
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
            switch ($item[6]) {
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
            $teste = new Teste();
            $teste->setId($item[0])
                ->setStatus($status)
                ->setDescricao($item[2])
                ->setValor($item[1])
                ->setData($item[4])
                ->setNome($item[5])
                ->setTipoEquipamento($tipo);
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

    public function findByTipo(int $tipo): array
    {
        switch ($tipo) {
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
        $sql = "SELECT id_teste, descricao, valor, nome, tipo_equipamento FROM teste WHERE tipo_equipamento = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('s', $tipo);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all();
        $testes = [];
        foreach ($data as $item) {
            switch ($item[4]) {
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
            $teste = new Teste();
            $teste->setId($item[0])
                ->setDescricao($item[1])
                ->setValor($item[2])
                ->setNome($item[3])
                ->setTipoEquipamento($tipo);
            $testes[] = $teste;
        }

        return $testes;
    }

}