<?php

require_once './connections/TesteDAO.php';
require_once './connections/EquipamentoDAO.php';
require_once './connections/PedidoDAO.php';

require_once './models/Equipamento.php';
require_once './models/TipoEquipamento.php';
require_once './models/Pedido.php';
require_once './models/StatusPedido.php';
require_once './models/Teste.php';
require_once './models/StatusTeste.php';

$equipamentoDAO = new EquipamentoDAO();
$testeDAO = new TesteDAO();
$pedidoDAO = new PedidoDAO();

if (!isset($_POST['nome']) or !isset($_POST['descricao']) or !isset($_POST['tipo']) or !isset($_POST['testes'])) {
    header('Location: ' . BASE_URL . 'novo-orcamento');
    exit();
}

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$tipo = $_POST['tipo'];
$testes = $_POST['testes'];

if (count($nome) != count($descricao) or count($nome) != count($tipo) or count($nome) != count($testes)) {
    header('Location: ' . BASE_URL . 'novo-orcamento');
    exit();
}


$equipamentos = array();

for ($i = 0; $i < count($nome); $i++) {
    $equipamento = new Equipamento();
    $equipamento->setModelo($nome[$i])
        ->setDescricao($descricao[$i])
        ->setTipo($tipo[$i]);
    foreach ($testes[$i] as $teste) {
        $teste = $testeDAO->findById($teste);
        if ($teste->getTipoEquipamento() == $equipamento->getTipo()) {
            $equipamento->addTeste($teste);
        }
    }
    $equipamentos[] = $equipamento;
}

$total = 0;
foreach ($equipamentos as $equipamento) {
    $total += $equipamento->getTotalValorTestes();
}

$hoje = new DateTime('now');
$hoje = $hoje->format('Y-m-d');

$pedido = new Pedido();

$pedido->setNumero($pedidoDAO->proximoNumero())
    ->setTotal($total)
    ->setStatus(StatusPedidoEnum::PENDENTE)
    ->setData($hoje)
    ->setEquipamentos($equipamentos);

$pedido = $pedidoDAO->create($pedido, $user->getId());

if ($pedido->getId() != null) {
    header('Location: ' . BASE_URL . 'orcamentos');
    exit();
} else {
    header('Location: ' . BASE_URL . 'novo-orcamento');
    exit();
}