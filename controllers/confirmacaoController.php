<?php
require_once './connections/ClienteDAO.php';

$cliente_dao = new ClienteDAO();

if (!isset($_GET['token'])) {
    header('Location: ' . BASE_URL . 'confirmacao');
}
// Obtém o token do link
$token = $_GET['token'];


// Verifica se o token existe no banco de dados
$id = $cliente_dao->findByToken($token);

if ($id === -1) {
    header('Location: ' . BASE_URL . 'confirmacao?tokenInvalido');
    exit;
}

// Atualiza o usuário como confirmado no banco de dados
if ($cliente_dao->verifica($id)) {
    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
        $_SESSION['user'] = $cliente_dao->findById($id);
        header('Location: ' . BASE_URL . 'home');
        exit;
    } else {
        header('Location: ' . BASE_URL . 'login?success');
        exit;
    }


}