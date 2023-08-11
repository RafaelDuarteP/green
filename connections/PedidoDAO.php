<?php

require_once "./connections/EquipamentoDAO.php";
require_once "./models/Pedido.php";
require_once "./models/StatusPedido.php";

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
            case StatusPedidoEnum::FINALIZADO:
                $status = "FINALIZADO";
                break;
        }
        $sql = "INSERT INTO pedido (data, numero, total, status, id_cliente) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->getConn()->prepare($sql);
        $data = $pedido->getData();
        $numero = $pedido->getNumero();
        $total = $pedido->getTotal();
        $stmt->bind_param("ssssi", $data, $numero, $total, $status, $idCliente);
        $stmt->execute();

        $pedido->setId($stmt->insert_id);

        foreach ($pedido->getEquipamentos() as $equipamento) {
            $equipamentoDao = new EquipamentoDAO();
            $equipamentoDao->create($equipamento, $pedido->getId());
        }

        return $pedido;
    }

    public function findById(int $id): ?Pedido
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT * FROM pedido WHERE id_pedido = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        $data = $result->fetch_assoc();
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
            case "FINALIZADO":
                $status = StatusPedidoEnum::FINALIZADO;
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
        $sql = "SELECT  status, id_pedido, data, numero, total  FROM pedido";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = $result->fetch_all();

        $pedidos = [];

        $pedidos = [];
        foreach ($data as $item) {
            switch ($item[0]) {
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
                case "FINALIZADO":
                    $status = StatusPedidoEnum::FINALIZADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item[1])
                ->setData($item[2])
                ->setNumero($item[3])
                ->setTotal($item[4])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item[1]));
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

    public function findByCliente(int $idCliente): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT status, id_pedido, data, numero, total FROM pedido WHERE id_cliente = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $idCliente);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all();

        $pedidos = [];
        foreach ($data as $item) {
            switch ($item[0]) {
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
                case "FINALIZADO":
                    $status = StatusPedidoEnum::FINALIZADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item[1])
                ->setData($item[2])
                ->setNumero($item[3])
                ->setTotal($item[4])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item[1]));
            $pedidos[] = $pedido;
        }

        return $pedidos;
    }
    public function findAprovadoByCliente(int $idCliente): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT status, id_pedido, data, numero, total FROM pedido WHERE id_cliente = ? and status = 'APROVADO'";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $idCliente);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all();

        $pedidos = [];
        foreach ($data as $item) {
            switch ($item[0]) {
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
                case "FINALIZADO":
                    $status = StatusPedidoEnum::FINALIZADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item[1])
                ->setData($item[2])
                ->setNumero($item[3])
                ->setTotal($item[4])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item[1]));
            $pedidos[] = $pedido;
        }

        return $pedidos;
    }
    public function findFinalizadoByCliente(int $idCliente): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT status, id_pedido, data, numero, total FROM pedido WHERE id_cliente = ? and status = 'FINALIZADO'";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $idCliente);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all();

        $pedidos = [];
        foreach ($data as $item) {
            switch ($item[0]) {
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
                case "FINALIZADO":
                    $status = StatusPedidoEnum::FINALIZADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item[1])
                ->setData($item[2])
                ->setNumero($item[3])
                ->setTotal($item[4])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item[1]));
            $pedidos[] = $pedido;
        }

        return $pedidos;
    }
    public function findOrcamentoByCliente(int $idCliente): array
    {
        $equipamentoDao = new EquipamentoDAO();
        $sql = "SELECT status, id_pedido, data, numero, total FROM pedido WHERE id_cliente = ? and status != 'APROVADO' and status != 'FINALIZADO'";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('i', $idCliente);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all();

        $pedidos = [];
        foreach ($data as $item) {
            switch ($item[0]) {
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
                case "FINALIZADO":
                    $status = StatusPedidoEnum::FINALIZADO;
                    break;
            }
            $pedido = new Pedido();
            $pedido->setId($item[1])
                ->setData($item[2])
                ->setNumero($item[3])
                ->setTotal($item[4])
                ->setStatus($status)
                ->setEquipamentos($equipamentoDao->findByPedido($item[1]));
            $pedidos[] = $pedido;
        }

        return $pedidos;
    }

    public function alterarStatus(int $id, int $status): bool
    {
        switch ($status) {
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
            case StatusPedidoEnum::FINALIZADO:
                $status = "FINALIZADO";
                break;
        }
        $sql = "UPDATE pedido SET status = ? WHERE id_pedido = ?";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->bind_param('si', $status, $id);

        return $stmt->execute();

    }

    public function proximoNumero(): int
    {
        $sql = "SELECT proximo_numero()";
        $stmt = $this->db->getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data['proximo_numero()'];
    }

}