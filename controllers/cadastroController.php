<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

require_once './connections/ClienteDAO.php';
require_once './connections/MailerDAO.php';
require_once './utils/email.php';

$cliente_dao = new ClienteDAO();
$mailer_dao = new MailerDAO();

// Verifica se o usuário já está logado
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    // Se o usuário já estiver logado, redireciona para a página inicial
    header('Location: ' . BASE_URL);
    exit;
}

// Verifica se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = mb_strtolower($_POST['email']);
    $senha = $_POST['senha'];
    $cnpj = preg_replace('/[.\-\/]/', '', $_POST['cnpj']);
    $razao_social = $_POST['razao_social'];

    //verifica se  o cliente já é cadastrado
    if ($cliente_dao->exists($email, $cnpj)) {
        header('Location: ' . BASE_URL . 'cadastro?erroClienteExistente');
        exit;
    }

    // Gera o token de confirmação
    $token = md5(uniqid(rand(), true));

    // Insere o cliente no banco de dados com o token de confirmação
    $cliente = new Cliente();
    $cliente->setNome($nome)
        ->setEmail($email)
        ->setSenha($senha)
        ->setCnpj($cnpj)
        ->setToken($token)
        ->setRazaoSocial($razao_social);

    // Adiciona o cliente ao banco
    if ($cliente_dao->create($cliente)) {

        try {
            // Envia o e-mail de confirmação com o token
            $mailer = new PHPMailer(true);

            $mailer->isSMTP();
            $mailer->CharSet = 'UTF-8';
            $mailer->Host = $_ENV['MAIL_HOST'];
            $mailer->SMTPAuth = true;
            $mailer->Username = $_ENV['MAIL_USERNAME'];
            $mailer->Password = $mailer_dao->getSenha();

            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = $_ENV['MAIL_PORT'];

            $mailer->setFrom($_ENV['MAIL_USERNAME'], 'Green');
            $mailer->addAddress($email, $nome);
            $mailer->Subject = 'Confirmação de E-mail';

            // Corpo do e-mail formatado com estilos CSS
            $mailer->isHTML(true);

            $host = $_SERVER['HTTP_HOST'];

            $mailer->Body = getBody($nome, $host, $token);

            $send = $mailer->send();
        } catch (Exception $e) {
            header('Location: ' . BASE_URL . 'cadastro?erroBanco');
            error_log("Erro: " . $e->getMessage());
        }


        // Redireciona para a página de sucesso
        header('Location: ' . BASE_URL . 'cadastro?sucesso');
        exit;
    } else {
        // Se houve um erro ao inserir o cliente no banco de dados, exibe uma mensagem de erro
        header('Location: ' . BASE_URL . 'cadastro?erroBanco');
        exit;
    }
}