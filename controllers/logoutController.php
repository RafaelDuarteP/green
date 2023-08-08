<?php
// Define a variável de sessão para indicar que o usuário está deslogado
$_SESSION['logado'] = false;
$_SESSION['control'] = false;

// Limpa as variáveis de sessão do usuário
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header('Location: /green/login');
exit;