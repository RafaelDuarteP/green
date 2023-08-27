<!DOCTYPE html>
<html>

<head>
    <title>404 - Página não encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #d9d9d9;
        }

        .container {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #ffcc00;
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            color: #333;
            font-size: 1.2em;
        }

        a {
            color: #004226;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">404 - Página não encontrada</h1>
            <p>Desculpe, a página que você está procurando não existe. Por favor, verifique se o endereço está correto e
                tente
                novamente.</p>
            <p>Você pode <a href="<?php echo BASE_URL ?>">voltar para a página inicial</a>.</p>
        </div>
    </div>
</body>

</html>