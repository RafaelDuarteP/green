<?php
require_once './connections/UserControlDAO.php';
require_once './models/UserControl.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'):

    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: ./adms');
        exit;
    }

    $id = intval($id);
    $userControlDAO = new UserControlDAO();
    $userControl = $userControlDAO->findById($id);

    ?>

<link rel="stylesheet" href="../assets/styles/home.css">
<link rel="stylesheet" href="../assets/styles/adm.css">
<title>ACESSO RESTRITO | Administradores</title>

<?php
    include_once "./components/header_restricted.php";
    ?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
            include_once "./components/sidebar.php";
            getSideBarRestricted(5);
            ?>




        <div class="col-9 px-5">
            <div class="row mt-4">
                <div class="col-12 titulo">
                    <div class="row">
                        <h1 class="col-9">Editar Administrador:
                            <?php echo $userControl->getNome() ?>
                        </h1>
                    </div>

                </div>
                <form action="editarAdm" method="post" id="formEditaADM">
                    <div class="modal-body">

                        <div class="row justify-content-center">
                            <input type="hidden" name="id" value="<?php echo $userControl->getId() ?>">
                            <div class="col-10">
                                <label class="form-label" for="nome">Nome</label>
                                <input class="form-control" type="Text" name="nome" id="nome" placeholder="nome"
                                    value="<?php echo $userControl->getNome() ?>" required>
                            </div>
                            <div class="col-10">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="email"
                                    value="<?php echo $userControl->getEmail() ?>" required>
                            </div>
                            <div class="col-5">
                                <label class="form-label" for="senha">Senha atual</label>
                                <input class="form-control" type="password" name="senha" id="senha"
                                    placeholder="********" required>
                            </div>
                            <div class="col-5">
                                <label class="form-label" for="novaSenha">Nova senha</label>
                                <input class="form-control" type="password" name="novaSenha" id="novaSenha"
                                    placeholder="********">
                                <p id="error-message" class="error-message d-none">A nova senha precisa ter ao menos 8
                                    caracteres
                                </p>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


</section>
<script src="../assets/scripts/adm.js" defer></script>

<?php

elseif ($_SERVER['REQUEST_METHOD'] === 'POST'):

    if (!isset($_POST['id']) or !isset($_POST['nome']) or !isset($_POST['email']) or !isset($_POST['senha']) or !isset($_POST['novaSenha'])) {
        header('Location: ./adms');
        exit;
    }

    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $novaSenha = $_POST['novaSenha'];

    $userControlDAO = new UserControlDAO();
    if ($userControlDAO->login($email, $senha) === false) {
        header('Location: ./adms?error=1');
        exit;
    }
    $userControl = $userControlDAO->findById($id);
    $userControl->setNome($nome)
        ->setEmail($email);
    if ($novaSenha !== '') {
        $userControl->setSenha($novaSenha);
    }



    $userControlDAO->update($userControl);
    header('Location: ./adms?success=1');
endif;