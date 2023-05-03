<?php
require_once './connections/ClienteDAO.php';

$cliente_dao = new ClienteDAO();

// Obtém o token do link
$token = $_GET['token'];

// Verifica se o token foi fornecido
if (!$token) {
    echo "Token inválido.";
    exit;
}

// Verifica se o token existe no banco de dados
$id = $cliente_dao->findByToken($token);

if ($id === -1) {
    echo "Token inválido.";
    exit;
}

// Atualiza o usuário como confirmado no banco de dados
if ($cliente_dao->verifica($id)) {
    echo "E-mail confirmado com sucesso!";
    $_SESSION['user'] = $cliente_dao->findById($id);
    header('Location: ' . BASE_URL . 'home');
    exit;
}

echo 'confirme seu email';