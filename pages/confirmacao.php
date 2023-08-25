<title>Confirme seu email</title>
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/confirmacao.css">




<section class="fundo">
    <div class="row h-100 justify-content-center align-items-center mx-0">
        <div class="col-4">
            <form action="auth/confirmacao" method="get" class="row justify-content-center form-cadastro">
                <?php if (isset($_GET['tokenInvalido'])): ?>
                    <div class="col-12 my-3">
                        <p class="info text-center w-100">Token inválido, tente reenviar por email</p>
                    </div>
                <?php endif; ?>
                <h1 class="titulo col-12 text-center">Confirme seu email</h1>
                <div class="col-12 my-3">
                    <p class="text-center"><img class="brasao-puc"
                            src="<?php echo BASE_URL ?>assets/imgs/logo_green.png" alt=""></p>
                </div>
                <div class="col-12 my-3">
                    <label for="token">Digite o token recebido pelo email</label>
                    <input type="text" name="token" id="token">
                </div>
                <div class="col-12 my-3">
                    <button class="btn" type="submit">Confirmar Email</button>
                </div>
                <div class="col-12 my-3">
                    <button class="btn-red" type="button">Reenviar Token</button>
                </div>
            </form>
        </div>
    </div>
</section>