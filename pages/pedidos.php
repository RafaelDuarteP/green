<link rel="stylesheet" href="./assets/styles/home.css">
<link rel="stylesheet" href="./assets/styles/pedido.css">
<title>Pedidos</title>


<?php
include_once "./components/header.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBar($user, 3);
        ?>

        <div class="col-9 area-pedidos">
            <div class="row py-3 justify-content-center">
                <div class="col-12 titulo">
                    <h2 class="w-100">Pedidos Ativos</h2>
                </div>

                <div class="col-11 pedido mt-4">
                    <div class="pedido-header">
                        <span>Pedido nº: <strong>123457</strong></span>
                        <span>10/08/2023</span>
                        <span>Total: <strong>R$ 10.000,00</strong></span>
                    </div>
                    <div class="divisor"></div>
                    <div class="pedido-body">
                        <h2>Equipamentos:</h2>
                        <div class="area-equip row justify-content-evenly">
                            <?php
                            include_once "./components/pedidos.php";
                            for ($i = 0; $i < 3; $i++) {
                                getPedido($i < 1);
                            }
                            ?>
                        </div>
                        <div class="details-equip px-5">
                            <div class="detail d-none">
                                <div class="progress-bar-container">
                                    <div class="line">
                                        <div class="line-progress"></div>
                                    </div>
                                    <ul class="progress-list">
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>10/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>11/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>12/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>13/10/2022</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="detail d-none">
                                <div class="progress-bar-container">
                                    <div class="line">
                                        <div class="line-progress"></div>
                                    </div>
                                    <ul class="progress-list">
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>10/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>11/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>12/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>13/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>14/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>15/10/2022</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="detail d-none">
                                <div class="progress-bar-container">
                                    <div class="line">
                                        <div class="line-progress"></div>
                                    </div>
                                    <ul class="progress-list">
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>10/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step active">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>11/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>12/10/2022</span>
                                            </div>
                                        </li>
                                        <li class="step">
                                            <div class="step-inner">
                                                <p>teste x</p> <span>13/10/2022</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="./assets/scripts/pedido.js" defer></script>