<?php

require_once './connections/ClienteDAO.php';

$cliente_dao = new ClienteDAO();

// Verifica se o usuário já está logado
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    // Se o usuário já estiver logado, redireciona para a página inicial
    header('Location: ' . BASE_URL);
    exit;
}



// Verifica se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém as credenciais do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if (strpos($login, "@") !== false) {
        $login = mb_strtolower($login);
    } else {
        $login = preg_replace('/[.\-\/]/', '', $login);
    }

    $cliente = $cliente_dao->findByEmailOrCNPJ($login);

    if ($cliente) {
        if ($cliente_dao->login($login, $senha)) {
            $_SESSION['logado'] = true;
            $_SESSION['user'] = $cliente;
            header('Location:' . BASE_URL . 'home');
            exit;
        } else {
            header('Location:' . BASE_URL . 'login?incorrectPass');
            exit;
        }

    } else {
        header('Location:' . BASE_URL . 'login?notFind');
        exit;
    }
}