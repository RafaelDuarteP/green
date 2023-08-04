<?php

require_once 'connections/Connection.php';
require_once 'models/Cliente.php';
require_once 'utils/converter.php';
require_once 'utils/rotas.php';

// Adiciona os assets
include 'components/head.php';

// Cria a conexão com o banco de dados
Connection::getInstance();

// Inicia a sessão
session_start();

// Define a URL base do projeto
define('BASE_URL', '/green/');

// Obtém a URL solicitada
$url = $_SERVER['REQUEST_URI'];

// Remove a barra no início da URL, se houver
$url = str_replace(BASE_URL, '', $url);

// Separa a URL em suas partes constituintes
$url_parts = parse_url($url);
$path = $url_parts['path'];
$query = $url_parts['query'] ?? '';

$user = $_SESSION['user'] ?? null;


//verifica se o acesso é por POST
if (strpos($path, "controller") !== false && $_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: ' . BASE_URL);
    exit;
}

if (isset($_SESSION['control']) && $_SESSION['control'] === true) {
    if (array_key_exists($path, $control_pages)) {
        include $control_pages[$path];
    } else {
        http_response_code(404);
        include 'pages/404.php';
    }
    exit;
}

// Verifica se a sessão está definida
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    // confirma se o usuário está verificado
    if (!$user->getVerificado() and $path != 'confirmacao' and $path != 'logout' and $path != 'auth/confirmacao') {
        header('Location: ' . BASE_URL . 'confirmacao');
        exit;
    }
    // Redireciona para a página inicial se a URL estiver vazia
    if ($path == '') {
        header('Location: ' . BASE_URL . 'home');
        exit;
    }
    // Verifica se a URL corresponde a uma página conhecida
    if (array_key_exists($path, $pages)) {
        // Se a URL corresponder a uma página conhecida, inclui o arquivo PHP correspondente
        include $pages[$path];
    } else if (array_key_exists($path, $access_pages)) {
        header('Location: ' . BASE_URL . 'home');
        exit;
    } else {
        // Se a URL não corresponder a nenhuma página conhecida, retorna um erro 404
        http_response_code(404);
        include 'pages/404.php';
    }
    // Verifica se a URL corresponde a uma página conhecida de acesso
} else if (array_key_exists($path, $access_pages)) {
    include $access_pages[$path];
} else {
    // Redireciona para pagina de login se não tiver logado
    header('Location: ' . BASE_URL . 'login');
    exit;
}

include 'components/scripts.php';