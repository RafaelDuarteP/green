<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/pedido.css">
<title>Pedidos</title>


<?php
require_once "./connections/PedidoDAO.php";
require_once "./connections/TesteDAO.php";

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

                <?php

                $pedidoDAO = new PedidoDAO();
                $pedidos = $pedidoDAO->findAprovadoByCliente($user->getId());

                foreach ($pedidos as $pedido):
                    ?>

                    <div class="col-11 pedido mt-4">
                        <div class="pedido-header">
                            <span>Pedido nº: <strong>
                                    <?php echo $pedido->getNumero() ?>
                                </strong></span>
                            <span>
                                <?php echo converterData($pedido->getData()) ?>
                            </span>
                            <span>Total: <strong>R$
                                    <?php echo converterNumeroFloat($pedido->getTotal()) ?>
                                </strong></span>
                        </div>
                        <div class="divisor"></div>
                        <div class="pedido-body">
                            <h2>Equipamentos:</h2>
                            <div class="area-equip row justify-content-evenly">
                                <?php
                                include_once "./components/componentes_pedidos.php";
                                foreach ($pedido->getEquipamentos() as $equipamento) {
                                    getPedido($equipamento->finalizado(), $equipamento->getModelo(), $equipamento->getTipo());
                                }
                                ?>
                            </div>
                            <div class="details-equip px-5">
                                <?php
                                foreach ($pedido->getEquipamentos() as $equipamento):
                                    ?>
                                    <div class="detail d-none">
                                        <div class="progress-bar-container">
                                            <div class="line">
                                                <div class="line-progress"></div>
                                            </div>
                                            <ul class="progress-list">
                                                <?php
                                                foreach ($equipamento->getTestes() as $teste):
                                                    ?>
                                                    <li class="step <?php if ($teste->getStatus() == StatusTesteEnum::FINALIZADO) {
                                                        echo 'active';
                                                    } ?>">
                                                        <div class="step-inner">
                                                            <p>
                                                                <?php echo $teste->getNome() ?>
                                                            </p>
                                                            <p>
                                                                <?php echo converterDataHora($teste->getData()) ?>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                endforeach;
                ?>
            </div>
            <div class="row py-3 justify-content-center">
                <div class="col-12 titulo">
                    <h2 class="w-100">Pedidos Finalizados</h2>
                </div>

                <?php

                $pedidoDAO = new PedidoDAO();
                $pedidos = $pedidoDAO->findFinalizadoByCliente($user->getId());

                foreach ($pedidos as $pedido):
                    ?>

                    <div class="col-11 pedido mt-4">
                        <div class="pedido-header">
                            <span>Pedido nº: <strong>
                                    <?php echo $pedido->getNumero() ?>
                                </strong></span>
                            <span>
                                <?php echo converterData($pedido->getData()) ?>
                            </span>
                            <span>Total: <strong>R$
                                    <?php echo converterNumeroFloat($pedido->getTotal()) ?>
                                </strong></span>
                            <span></span>
                            <?php
                            include_once "./components/status_orcamento.php";
                            getStatus($pedido->getStatus());
                            ?>
                        </div>
                        <div class="divisor"></div>
                        <div class="pedido-body">
                            <h2>Equipamentos:</h2>
                            <div class="area-equip row justify-content-evenly">
                                <?php
                                include_once "./components/componentes_pedidos.php";
                                foreach ($pedido->getEquipamentos() as $equipamento) {
                                    getPedido($equipamento->finalizado(), $equipamento->getModelo(), $equipamento->getTipo());
                                }
                                ?>
                            </div>
                            <div class="details-equip px-5">
                                <?php
                                foreach ($pedido->getEquipamentos() as $equipamento):
                                    ?>
                                    <div class="detail d-none">
                                        <div class="progress-bar-container">
                                            <div class="line">
                                                <div class="line-progress"></div>
                                            </div>
                                            <ul class="progress-list">
                                                <?php
                                                foreach ($equipamento->getTestes() as $teste):
                                                    ?>
                                                    <li class="step <?php if ($teste->getStatus() == StatusTesteEnum::FINALIZADO) {
                                                        echo 'active';
                                                    } ?>">
                                                        <div class="step-inner">
                                                            <p>
                                                                <?php echo $teste->getNome() ?>
                                                            </p>
                                                            <p>
                                                                <?php echo converterDataHora($teste->getData()) ?>
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo BASE_URL ?>assets/scripts/pedido.js" defer></script>