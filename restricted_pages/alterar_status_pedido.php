<?php
require_once './models/StatusPedido.php';
require_once './connections/PedidoDAO.php';

if (!isset($_POST['id']) || !isset($_POST['status'])) {
    header('Location:' . BASE_URL . 'restricted/orcamentos');
    exit();
}

$id = intval($_POST['id']);
$status = intval($_POST['status']);

$pedidoDAO = new PedidoDAO();
if ($pedidoDAO->alterarStatus($id, $status)) {
    switch ($status) {
        case StatusPedidoEnum::AGUARDANDO:
        case StatusPedidoEnum::PENDENTE:
        case StatusPedidoEnum::CANCELADO:
            header('Location:' . BASE_URL . 'restricted/orcamentos');
            exit();
        case StatusPedidoEnum::APROVADO:
        case StatusPedidoEnum::FINALIZADO:
            header('Location:' . BASE_URL . 'restricted/pedidos');
            exit();
    }
} else {
    header('Location:' . BASE_URL . 'restricted/orcamentos');
    exit();
}