<header class="container-fluid">
    <div class="row justify-content-between align-items-center px-4">
        <div class="col-2 ms-2">
            <img src="../assets/imgs/logo_green_typo.png" alt="">
        </div>
        <div class="col-auto">
            <h2>Olá,
                <?php echo $user->getNome(); ?>
            </h2>
        </div>
        <div class="col-1">
            <p> <a href="logout">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a> </p>
        </div>
    </div>
</header>