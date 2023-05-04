<link rel="stylesheet" href="./assets/styles/login.css">
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
            <form action="controller/cadastro" method="post" class="row justify-content-center">
                <h1 class="titulo col-12 text-center">Entrar</h1>
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
                    <input type="text" name="cnpj" id="cnpj" placeholder="00.000/000-1">
                </div>
                <div class="col-12 my-1">
                    <label for="razao_social">Razao social:</label>
                    <input type="text" name="razao_social" id="razao_social" placeholder="00.000/000-1">
                </div>
                <div class="col-12 my-1">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="*******">
                </div>
                <div class="col-12 my-1">
                    <label for="senha_confirma">Confirme sua senha:</label>
                    <input type="password" name="senha_confirma" id="senha_confirma" placeholder="*******">
                </div>
                <div class="col-12 my-4">
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