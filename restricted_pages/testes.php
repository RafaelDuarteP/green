<?php
require_once './connections/ClienteDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';
?>

<link rel="stylesheet" href="../assets/styles/home.css">
<link rel="stylesheet" href="../assets/styles/orcamento.css">
<title>ACESSO RESTRITO | Testes</title>

<?php
include_once "./components/header_restricted.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBarRestricted(4);
        ?>


        <div class="col-9 area-orcamentos">

        </div>
    </div>


</section>