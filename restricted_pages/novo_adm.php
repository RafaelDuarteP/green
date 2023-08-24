<?php

require_once './connections/UserControlDAO.php';
require_once './models/UserControl.php';

if (!isset($_POST['nome']) or !isset($_POST['email']) or !isset($_POST['senha'])) {
    header('Location: ' . BASE_URL . 'restricted/adms');
    exit();
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$userControl = new UserControl();
$userControl->setNome($nome)
    ->setEmail($email)
    ->setSenha($senha);

$userControlDAO = new UserControlDAO();
$userControl = $userControlDAO->create($userControl);

header('Location: ' . BASE_URL . 'restricted/adms');