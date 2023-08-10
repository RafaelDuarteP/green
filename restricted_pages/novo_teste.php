<?php

require_once './connections/TesteDAO.php';

require_once './models/TipoEquipamento.php';
require_once './models/Teste.php';

$testeDAO = new TesteDAO();

if (!isset($_POST['nome']) or !isset($_POST['descricao']) or !isset($_POST['tipo']) or !isset($_POST['valor'])) {
    header('Location: ' . BASE_URL . 'restricted/testes');
    exit();
}

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$tipo = $_POST['tipo'];
$valor = $_POST['valor'];

$teste = new Teste();
$teste->setNome($nome)
    ->setDescricao($descricao)
    ->setTipoEquipamento($tipo)
    ->setValor($valor);

$teste = $testeDAO->create($teste);

if ($teste->getId() != null) {
    header('Location: ' . BASE_URL . 'restricted/testes');
    exit();
} else {
    header('Location: ' . BASE_URL . 'restricted/testes?erro=1');
    exit();
}