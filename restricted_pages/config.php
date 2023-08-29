<?php

?>

<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/adm.css">
<title>ACESSO RESTRITO | Configurações</title>

<?php
include_once "./components/header_restricted.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBarRestricted(6);
        ?>

        <div class="col-9 px-5">
            <div class="row mt-4">
                <div class="col-12 titulo">
                    <div class="row">
                        <h1 class="col-9">Configurações</h1>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <ul class="options fa-ul">
                    <li class="fa-solid fa-edit">
                        <button class="btn option-config" type="button" data-bs-toggle="modal"
                            data-bs-target="#modalNovo">Atualizar senha do email</button>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</section>

<div class="modal" tabindex="-1" id="modalNovo" aria-labelledby="modalNovoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="config/atualizarSenha" method="post" id="formAtualizarSenha">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNovoLabel">Atualizar Senha do Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <div class="col-5">
                            <label class="form-label" for="senha">Nova senha:</label>
                            <input class="form-control" type="password" name="senha" id="senha" placeholder="********"
                                required>
                        </div>
                        <div class="col-5">
                            <label class="form-label" for="confirmarSenha">Confirme a senha:</label>
                            <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha"
                                placeholder="********" required>

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

<script src="<?php echo BASE_URL ?>assets/scripts/config.js" defer></script>