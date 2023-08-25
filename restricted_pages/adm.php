<?php
require_once './connections/UserControlDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';
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
                        <h1 class="col-9">Administradores</h1>
                        <button class="btn col-3" type="button" data-bs-toggle="modal" data-bs-target="#modalNovo">
                            <i class="fa-solid fa-plus"></i> Novo
                            Administrador</button>
                    </div>

                </div>

                <?php
                $userControlDAO = new UserControlDAO();
                $users = $userControlDAO->findAll();

                foreach ($users as $user):
                    ?>

                    <div class="row mt-4 card-cliente">
                        <div class="col-4 mt-2 mb-2">Nome: <span>
                                <?php echo $user->getNome() ?>
                            </span>
                        </div>
                        <div class="col-4 mt-2 mb-2">Email:
                            <a href="mailto:<?php echo $user->getEmail() ?>">
                                <?php echo $user->getEmail() ?>
                            </a>
                        </div>
                        <div class="col-4 mt-2 text-end">
                            <a href="editarAdm?id=<?php echo $user->getId() ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>

        </div>
    </div>


</section>

<div class="modal" tabindex="-1" id="modalNovo" aria-labelledby="modalNovoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="novoAdm" method="post" id="formNovoADM">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNovoLabel">Novo adiminnistrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <div class="col-10">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control" type="Text" name="nome" id="nome" placeholder="nome" required>
                        </div>
                        <div class="col-10">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="email"
                                required>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="senha">Senha</label>
                            <input class="form-control" type="password" name="senha" id="senha" placeholder="********"
                                required>
                            <p id="error-message-senha" class="error-message d-none">A senha precisa ter ao menos 8
                                caracteres
                            </p>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="confirmarSenha">Confirme a senha</label>
                            <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha"
                                placeholder="********" required>
                            <p id="error-message" class="error-message d-none">As senhas não são iguais</p>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../assets/scripts/adm.js" defer></script>