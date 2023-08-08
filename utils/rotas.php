<?php

$pages = array(
    'home' => 'pages/home.php',
    'pedidos' => 'pages/pedidos.php',
    'dados' => 'pages/dados.php',
    'orcamentos' => 'pages/orcamentos.php',
    'novo-orcamento' => 'pages/novo_orcamento.php',
    'logout' => 'controllers/logoutController.php',
    'auth/confirmacao' => 'controllers/confirmacaoController.php',
    'confirmacao' => 'pages/confirmacao.php',
    'controller/novo-orcamento' => 'controllers/novoOrcamentoController.php',
);

$access_pages = array(
    'login' => 'pages/login.php',
    'cadastro' => 'pages/cadastro.php',
    'controller/login' => 'controllers/loginController.php',
    'controller/cadastro' => 'controllers/cadastroController.php',
    'auth/confirmacao' => 'controllers/confirmacaoController.php',
    'confirmacao' => 'pages/confirmacao.php',
    'restricted/login' => 'restricted_pages/login.php',
);

$control_pages = array(
    'restricted/home' => 'restricted_pages/home.php',
    'restricted/orcamentos' => 'restricted_pages/orcamentos.php',
    'restricted/pedidos' => 'restricted_pages/pedidos.php',
    'restricted/testes' => 'restricted_pages/testes.php',
    'restricted/alterarTeste' => 'restricted_pages/alterar_teste.php',
    'restricted/logout' => 'controllers/logoutController.php',
);