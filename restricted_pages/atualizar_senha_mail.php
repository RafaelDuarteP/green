<?php

if (!isset($_POST['senha']) or !isset($_POST['confirmarSenha'])) {
    header('Location: ' . BASE_URL . 'restricted/config?error');
    exit;
}

$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmarSenha'];

if ($senha != $confirmarSenha) {
    header('Location: ' . BASE_URL . 'restricted/config?error');
    exit;
}

require_once './connections/MailerDAO.php';
$mailer_dao = new MailerDAO();
$mailer_dao->updateSenha($senha);

header('Location: ' . BASE_URL . 'restricted/config?success=senhaAtualizada');