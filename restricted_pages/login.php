<?php

require_once './connections/UserControlDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userDAO = new UserControlDAO();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    echo $email;
    echo '<br>';
    echo $senha;

    echo '<br>';
    echo '<br>';
    echo '<br>';


    if ($userDAO->login($email, $senha)) {
        $_SESSION['user'] = $userDAO->findByEmail($email);
        $_SESSION['control'] = true;
        header('Location:' . BASE_URL . 'restricted/home');
        exit();
    } else {
        header('Location:' . BASE_URL . 'restricted/login?incorrectPass');
    }

}

?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET'):
    ?>
<link rel="stylesheet" href="../assets/styles/login.css">
<title>ACESSO RESTRITO | Login</title>

<section class="container-fluid">
    <div class="row justify-content-evenly">
        <div class="col-5 caption-login vh-100">
            <h1 class="titulo">ACESSO RESTRITO | Login</h1>
            <img class="logo-green" src="../assets/imgs/logo_green_typo.png" alt="Logo GREEN">
            <div class="infos">
                <?php
                    if (isset($_GET['incorrectPass'])): ?>
                <p class="col-12 text-center info-message">Usuário ou senha incorretos</p>
                <?php endif; ?>
            </div>

        </div>

        <div class="col-4 form-login">
            <form action="" method="post" class="row justify-content-center">
                <h1 class="titulo col-12 text-center">Entrar</h1>
                <div class="col-12 my-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="col-12 my-3">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="*******">
                </div>
                <div class="col-12 my-5">
                    <button class="btn-login" type="submit">Entrar</button>
                </div>
                <div class="col-12 my-3">
                    <p class="text-center"><img class="brasao-puc" src="../assets/imgs/brasao_puc_minas.png" alt=""></p>

                </div>
            </form>
        </div>
    </div>
</section>


<!-- <form action="" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha">
    <br>
    <input type="submit" value="Enviar">
</form> -->
<?php
endif;
?>