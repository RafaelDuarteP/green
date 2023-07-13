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

echo "<pre>";

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$tipo = $_POST['tipo'];
$testes = $_POST['testes'];

// var_dump($nome);
// var_dump($descricao);
// var_dump($tipo);
// var_dump($testes);

$equipamentos = array();

for ($i = 0; $i < count($nome); $i++) {
    $equipamento = new Equipamento();
    $equipamento->setNome($nome[$i])
        ->setDescricao($descricao[$i])
        ->setTipo($tipo[$i]);
    foreach ($testes[$i] as $teste) {
        $teste = $testeDAO->findById($teste);
        $equipamento->addTeste($teste);
    }
    $equipamentos[] = $equipamento;
}

// var_dump($equipamentos);
$total = 0;
foreach ($equipamentos as $equipamento) {
    $total += $equipamento->getTotalValorTestes();
}

$hoje = new DateTime('now');
$hoje = $hoje->format('Y-m-d');

$pedido = new Pedido();

$pedido->setNumero(9)
    ->setTotal($total)
    ->setStatus(StatusPedidoEnum::PENDENTE)
    ->setData($hoje)
    ->setEquipamentos($equipamentos);

$pedido = $pedidoDAO->create($pedido, $user->getId());
var_dump($pedido);


echo "</pre>";