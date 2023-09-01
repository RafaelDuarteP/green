<?php

function getBody($nome, $host, $token): string
{
    $estilosCSS = "
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #d9d9d9;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #ffffff;
                        border-radius: 5px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background-color: #004226;
                        color: #ffffff;
                        text-align: center;
                        padding: 15px;
                    }
                    .content {
                        padding: 20px;
                    }
                    .btn {
                        display: inline-block;
                        background-color: #ffcc00;
                        color: #004226;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 5px;
                        font-weight: bold;
                        margin: auto;
                    }
                    .footer {
                        text-align: center;
                        padding-top: 20px;
                    }
                    .logo {
                        max-width: 150px; /* Defina o tamanho máximo desejado para a logo */
                        display: block;
                        margin: 0 auto;
                    }
                </style>
            ";
    return <<<HTML
                {$estilosCSS}
                <div class="container">
                    <div class="header">
                        <h1>Confirmação de E-mail</h1>
                    </div>
                    <div class="content">
                        <p>Olá {$nome},</p>
                        <p>Clique no botão abaixo para confirmar seu endereço de e-mail:</p>
                        <p><a class="btn" href="{$host}/auth/confirmacao?token={$token}">CONFIRME SEU EMAIL</a></p>
                        <p>Ou utilize o código: <strong>{$token}</strong> em seu primeiro login.</p>
                        <p>Obrigado por se cadastrar em nossa plataforma.</p>
                        
                        <!-- Mensagem de e-mail automático -->
                        <p>Este é um e-mail automático. Por favor, não responda a este e-mail, pois não é monitorado.</p>

                        <!-- Mensagem de token copiado -->
                        <p id="mensagem-copiado" style="display: none; color: green;">Token copiado para a área de transferência!</p>
                    </div>
                    <div class="footer">
                        <img src="https://green.pucminas.br/assets/imgs/logo_green_typo.png" alt="Logo da Empresa" class="logo">
                    </div>
                </div>
HTML;
}