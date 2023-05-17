<link rel="stylesheet" href="./assets/styles/login.css">
<script src="./assets/scripts/login.js" defer></script>
<title>Login</title>

<section class="container-fluid">
    <div class="row justify-content-evenly">
        <div class="col-5 caption-login vh-100">
            <h1 class="titulo">Area do Cliente</h1>
            <img class="logo-green" src="./assets/imgs/logo_green_typo.png" alt="Logo GREEN">
            <div class="infos">
                <?php if (isset($_GET['notFind'])): ?>
                    <p class="col-12 text-center info-message">Usuário não encontrado</p>
                <?php endif;
                if (isset($_GET['incorrectPass'])): ?>
                    <p class="col-12 text-center info-message">Senha incorreta</p>
                <?php endif; ?>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="infos">
                    <p class="col-12 text-center info-success">Email confirmado, faça login para continuar</p>
                </div>
            <?php endif; ?>

        </div>

        <div class="col-4 form-login">
            <form action="controller/login" method="post" class="row justify-content-center">
                <h1 class="titulo col-12 text-center">Entrar</h1>
                <div class="col-12 my-3">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login" placeholder="Email ou CNPJ">
                </div>
                <div class="col-12 my-3">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="*******">
                </div>
                <div class="col-12 my-5">
                    <button class="btn-login" type="submit">Entrar</button>
                </div>
                <div class="col-12 my-3">
                    <p class="text-center"><img class="brasao-puc" src="./assets/imgs/brasao_puc_minas.png" alt=""></p>
                </div>
            </form>
        </div>

        <div class="col-2 vh-100 cadastrar">
            <a class="link-cadastro" href="cadastro">
                <div class="play-circle">
                    <div class="play-triangle"></div>
                </div>
                <p>Cadastrar</p>
            </a>
        </div>
    </div>
</section>