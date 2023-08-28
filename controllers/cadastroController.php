<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

require_once './connections/ClienteDAO.php';
require_once './connections/MailerDAO.php';

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
            $mailer->Host = $_ENV['MAIL_HOST'];
            $mailer->SMTPAuth = true;
            $mailer->Username = $_ENV['MAIL_USERNAME'];
            $mailer->Password = $mailer_dao->getSenha();

            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = $_ENV['MAIL_PORT'];

            $mailer->setFrom($_ENV['MAIL_USERNAME'], 'Green');
            $mailer->addAddress($email, $nome);
            $mailer->Subject = 'Confirmação de E-mail';

            $estilosCSS = "
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #d9d9d9;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #004226;
                color: #ffffff;
                text-align: center;
                padding: 15px;
            }
            .content {
                padding: 20px;
            }
            .btn {
                display: inline-block;
                background-color: #ffcc00;
                color: #004226;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                margin: auto;
            }
            .footer {
                text-align: center;
                padding-top: 20px;
            }
        </style>
    ";

            // Anexa a logo ao e-mail
            $imagemLogo = './assets/imgs/logo_green.png'; // Caminho relativo para a imagem
            $mailer->addAttachment($imagemLogo, 'logo.png');

            // Corpo do e-mail formatado com estilos CSS
            $mailer->isHTML(true);

            $mailer->Body = <<<HTML
        {$estilosCSS}
        <div class="container">
            <div class="header">
                <h1>Confirmação de E-mail</h1>
            </div>
            <div class="content">
                <p>Olá {$nome},</p>
                <p>Clique no botão abaixo para confirmar seu endereço de e-mail:</p>
                <p><a class="btn" href="https://green.pucminas.br/confirmar-email?token={$token}">CONFIRME SEU EMAIL</a></p>
                <p>Ou utilize o código: <strong>{$token}</strong> em seu primeiro login.</p>
                <p>Obrigado por se cadastrar em nossa plataforma.</p>
            </div>
            <div class="footer">
                <img src="cid:logo" alt="Logo da Empresa">
            </div>
        </div>
    HTML;

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