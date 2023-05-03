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
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];

    //verifica se  o cliente já é cadastrado
    if ($cliente_dao->exists($email, $cnpj)) {
        header('Location: ' . BASE_URL . 'cadastro?erroExiste');
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

        // Envia o e-mail de confirmação com o token
        // $to = $email;
        // $subject = "Confirmação de E-mail";
        // $message = "Olá " . $nome . ",\n\n";
        // $message .= "Clique no link abaixo para confirmar seu endereço de e-mail:\n\n";
        // $confirmationLink = BASE_URL . "confirmar-email?token=" . $token;
        // $message .= $confirmationLink . "\n\n";
        // $message .= "Obrigado por se cadastrar em nossa plataforma.\n\n";
        // $from = "noreply@green.puc.br";
        // $headers = "From:" . $from;
        // mail($to, $subject, $message, $headers);

        // Redireciona para a página de sucesso
        header('Location: ' . BASE_URL . 'cadastro?sucesso');
        exit;
    } else {
        // Se houve um erro ao inserir o cliente no banco de dados, exibe uma mensagem de erro
        header('Location: ' . BASE_URL . 'cadastro?erroBanco');
        exit;
    }
}