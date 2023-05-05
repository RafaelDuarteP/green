<link rel="stylesheet" href="./assets/styles/login.css">
<script src="./assets/scripts/cadastro.js" defer></script>
<title>Cadastro</title>

<section class="container-fluid">
    <div class="row justify-content-evenly">
        <div class="col-2 vh-100 cadastrar">
            <a class="link-cadastro" href="login">
                <div class="play-circle">
                    <div class="play-triangle-cadastro"></div>
                </div>
                <p>Entrar</p>
            </a>
        </div>

        <div class="col-4 form-cadastro pt-4">
            <form id="form-cadastro" action="controller/cadastro" method="post" class="row justify-content-center">
                <h1 class="titulo col-12 text-center">Cadastrar</h1>
                <div class="col-12 my-1">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="email@example.com">
                </div>
                <div class="col-12 my-1">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="nome fantasia">
                </div>
                <div class="col-12 my-1">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00"
                        data-mask="00.000.000/0000-00" data-mask-reverse="true">
                </div>
                <div class="col-12 my-1">
                    <label for="razao_social">Razão social:</label>
                    <input type="text" name="razao_social" id="razao_social" placeholder="razão social">
                </div>
                <div class="col-12 my-1">
                    <label id="label-senha" for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="*******">
                    <p id="error-message-senha" class="error-message d-none">A senha precisa ter ao menos 8 caracteres
                    </p>
                </div>
                <div class="col-12 my-1">
                    <label id="label-confirma" for="senha_confirma">Confirme sua senha:</label>
                    <input type="password" name="senha_confirma" id="senha_confirma" placeholder="*******">
                    <p id="error-message" class="error-message d-none">As senhas não são iguais</p>
                </div>
                <div class="col-8 my-0 form-check">
                    <input class="form-check-input" type="checkbox" name="termo" id="termo" value="">
                    <label class="form-check-label" for="termo">Li e aceito os
                        <a href="#">termos de uso </a> e
                        <a href="#"> de privacidade </a>
                    </label>
                </div>
                <div class="col-12 my-1">
                    <button class="btn-login" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>


        <div class="col-5 caption-login vh-100">
            <h1 class="titulo">Area do Cliente</h1>
            <img class="logo-green" src="./assets/imgs/logo_green_typo.png" alt="Logo GREEN">
        </div>
    </div>
</section>