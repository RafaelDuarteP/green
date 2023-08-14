<?php

require_once 'connections/Connection.php';
require_once 'models/Cliente.php';
require_once 'models/UserControl.php';
require_once 'utils/converter.php';
require_once 'utils/rotas.php';

// Adiciona os assets
include 'components/head.php';

Connection::getInstance();
session_start();

define('BASE_URL', '/green/');

$url = $_SERVER['REQUEST_URI'];
if (substr($url, -1) === '/' && $url != BASE_URL) {
    $url = substr($url, 0, -1);
    header('Location: ' . $url);
}
$url = str_ireplace(BASE_URL, '', $url);

$url_parts = parse_url($url);
$path = $url_parts['path'];
$query = $url_parts['query'] ?? '';
$user = $_SESSION['user'] ?? null;

if (strpos($path, "controller") !== false && $_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: ' . BASE_URL);
    exit;
}

if (isset($_SESSION['control']) && $_SESSION['control'] === true) {
    if ($path == '' || $path == 'home' || $path == 'restricted') {
        header('Location: ' . BASE_URL . 'restricted/home');
        exit;
    }
    if (array_key_exists($path, $control_pages)) {
        include $control_pages[$path];
    } else {
        http_response_code(404);
        include 'pages/404.php';
    }
} elseif (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    if (!$user->getVerificado() and $path != 'confirmacao' and $path != 'logout' and $path != 'auth/confirmacao') {
        header('Location: ' . BASE_URL . 'confirmacao');
        exit;
    }
    if ($path == '') {
        header('Location: ' . BASE_URL . 'home');
        exit;
    }
    if (array_key_exists($path, $pages)) {
        include $pages[$path];
    } else if (array_key_exists($path, $access_pages)) {
        header('Location: ' . BASE_URL . 'home');
        exit;
    } else {
        http_response_code(404);
        include 'pages/404.php';
    }
} elseif (array_key_exists($path, $access_pages)) {
    include $access_pages[$path];
} else {
    header('Location: ' . BASE_URL . 'login');
    exit;
}


include 'components/scripts.php';