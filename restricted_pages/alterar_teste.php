<?php
require_once './connections/TesteDAO.php';
require_once './models/StatusTeste.php';

$id_equipamento = $_POST['equipamento'] ?? null;
$id_teste = $_POST['teste'] ?? null;

if (is_null($id_equipamento) || is_null($id_teste)) {
    header('Location:' . BASE_URL . 'restricted/pedidos');
    exit;
}

$testeDAO = new TesteDAO();

if ($testeDAO->updateStatus($id_equipamento, $id_teste, StatusTesteEnum::FINALIZADO)) {
    header('Location:' . BASE_URL . 'restricted/pedidos');
    exit;
} else {
    header('Location:' . BASE_URL . 'restricted/pedidos');
    exit;
}