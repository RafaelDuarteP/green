<?php
require_once './connections/ClienteDAO.php';
require_once './models/Cliente.php';
?>

<link rel="stylesheet" href="../assets/styles/home.css">
<title>ACESSO RESTRITO | Home</title>

<?php
include_once "./components/header_restricted.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBarRestricted(1);
        ?>

        <div class="col-9 px-5">
            <div class="row mt-4">
                <div class="col-12 titulo">
                    <h1>Clientes</h1>
                </div>

                <?php
                $clienteDAO = new ClienteDAO();
                $clientes = $clienteDAO->findAll();

                foreach ($clientes as $cliente):
                    ?>

                <div class="row mt-4 card-cliente">
                    <div class="col-4 mt-2">Nome: <span>
                            <?php echo $cliente->getNome() ?>
                        </span>
                    </div>
                    <div class="col-4 mt-2">Email:
                        <a href="mailto:<?php echo $cliente->getEmail() ?>">
                            <?php echo $cliente->getEmail() ?>
                        </a>
                    </div>
                    <div class="col-4 mt-2">CNPJ: <span>
                            <?php echo formatarCnpj($cliente->getCnpj()) ?>
                        </span>
                    </div>
                    <div class="col-4 mt-2">Razão Social: <span>
                            <?php echo $cliente->getRazaoSocial() ?>
                        </span>
                    </div>
                    <div class="col-4 mt-2">Verificado: <span>
                            <?php if ($cliente->getVerificado() === true): ?>
                            <i class="fa-solid fa-circle-check"></i>
                            <?php else: ?>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>

        </div>
</section>