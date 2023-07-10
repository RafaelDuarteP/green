<?php

class PedidoDAO
{

    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    public function create(Pedido $pedido, int $idCliente): Pedido
    {
        switch ($pedido->getStatus()) {
            case StatusPedidoEnum::PENDENTE:
                $status = "PENDENTE";
                break;
            case StatusPedidoEnum::APROVADO:
                $status = "APROVADO";
                break;
            case StatusPedidoEnum::AGUARDANDO:
                $status = "AGUARDANDO";
                break;
            case StatusPedidoEnum::CANCELADO:
                $status = "CANCELADO";
                break;
        }
        $sql = "INSERT INTO pedido (data, numero, total, status, id_cliente) VALUES (:data, :numero, :total, :status, :id_cliente)";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':data', $pedido->getData());
        $stmt->bindValue(':numero', $pedido->getNumero());
        $stmt->bindValue(':total', $pedido->getTotal());
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id_cliente', $idCliente);
        $stmt->execute();

        $pedido->setId($stmt->insert_id);
        $this->db->close();

        foreach ($pedido->getEquipamentos() as $equipamento) {
            $equipamentoDao = new EquipamentoDAO();
            $equipamentoDao->create($equipamento, $pedido->getId());
        }

        return $pedido;
    }

    public function findById(int $id): Pedido
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT * FROM pedido WHERE id_pedido = :id";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch_assoc();
        $this->db->close();
        switch ($data['status']) {
            case "PENDENTE":
                $status = StatusPedidoEnum::PENDENTE;
                break;
            case "APROVADO":
                $status = StatusPedidoEnum::APROVADO;
                break;
            case "AGUARDANDO":
                $status = StatusPedidoEnum::AGUARDANDO;
                break;
            case "CANCELADO":
                $status = StatusPedidoEnum::CANCELADO;
                break;
        }
        $pedido = new Pedido();
        $pedido->setId($data['id_pedido'])
            ->setData($data['data'])
            ->setNumero($data['numero'])
            ->setTotal($data['total'])
            ->setStatus($status)
            ->setEquipamentos($equipamentoDao->findByPedido($data['id_pedido']));
        return $pedido;
    }

    public function findAll(): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT * FROM pedido";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $this->db->close();
        $pedidos = [];

        foreach ($data as $item) {
            switch ($item['status']) {
                case "PENDENTE":
                    $status = StatusPedidoEnum::PENDENTE;
                    break;
                case "APROVADO":
                    $status = StatusPedidoEnum::APROVADO;
                    break;
                case "AGUARDANDO":
                    $status = StatusPedidoEnum::AGUARDANDO;
                    break;
                case "CANCELADO":
                    $status = StatusPedidoEnum::CANCELADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item['id_pedido'])
                ->setData($item['data'])
                ->setNumero($item['numero'])
                ->setTotal($item['total'])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item['id_pedido']));
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

    public function findByCliente(int $idCliente): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT * FROM pedido WHERE id_cliente = :id_cliente";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bindValue(':id_cliente', $idCliente);
        $stmt->execute();
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        $pedidos = [];
        $this->db->close();

        foreach ($data as $item) {
            switch ($item['status']) {
                case "PENDENTE":
                    $status = StatusPedidoEnum::PENDENTE;
                    break;
                case "APROVADO":
                    $status = StatusPedidoEnum::APROVADO;
                    break;
                case "AGUARDANDO":
                    $status = StatusPedidoEnum::AGUARDANDO;
                    break;
                case "CANCELADO":
                    $status = StatusPedidoEnum::CANCELADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item['id_pedido'])
                ->setData($item['data'])
                ->setNumero($item['numero'])
                ->setTotal($item['total'])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item['id_pedido']));
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

}