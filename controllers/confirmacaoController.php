<?php
require_once './connections/ClienteDAO.php';

$cliente_dao = new ClienteDAO();

if (isset($_GET['token'])):
    // Obtém o token do link
    $token = $_GET['token'];


    // Verifica se o token existe no banco de dados
    $id = $cliente_dao->findByToken($token);

    if ($id === -1):
        header('Location: ' . BASE_URL . 'confirmacao?tokenInvalido');
        exit;
    endif;

    // Atualiza o usuário como confirmado no banco de dados
    if ($cliente_dao->verifica($id)):
        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true):
            $_SESSION['user'] = $cliente_dao->findById($id);
            header('Location: ' . BASE_URL . 'home');
            exit;
        else:
            $msg = "Cadastro realizado com sucesso!";
            echo "<script>alert('$msg');</script>";
            header('Location: ' . BASE_URL . 'login');
            exit;
        endif;
    endif;

else:
    ?>
<?php if (isset($_GET['tokenInvalido'])): ?>
<p>Token invalido, tente reenviar o token por email</p>
<?php endif;?>
<form action="" method="get">
    <p>Digite token enviado pelo email</p>
    <input type="text" name="token" id="token">
    <input type="submit" value="">
</form>

<?php
endif;