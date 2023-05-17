<title>Confirme seu email</title>

<?php if (isset($_GET['tokenInvalido'])): ?>
    <p>Token invalido, tente reenviar o token por email</p>
<?php endif; ?>
<form action="auth/confirmacao" method="get">
    <p>Digite token enviado pelo email</p>
    <input type="text" name="token" id="token">
    <input type="submit" value="">
</form>