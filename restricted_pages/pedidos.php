<?php
require_once './connections/ClienteDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';
?>

<link rel="stylesheet" href="../assets/styles/home.css">
<link rel="stylesheet" href="../assets/styles/pedido.css">
<title>ACESSO RESTRITO | Pedidos</title>

<?php
include_once "./components/header_restricted.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBarRestricted(3);
        ?>

        <div class="col-9 area-pedidos">
            <div class="row py-3 justify-content-center">
                <div class="col-12 titulo">
                    <h2 class="w-100">Pedidos Ativos</h2>
                </div>

                <?php
                $clienteDAO = new ClienteDAO();
                $clientes = $clienteDAO->findAll();

                foreach ($clientes as $cliente):
                    $pedidoDAO = new PedidoDAO();
                    $pedidos = $pedidoDAO->findAprovadoByCliente($cliente->getId());
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
                        <span>Total: <strong>
                                <?php echo converterNumeroFloat($pedido->getTotal()) ?>
                            </strong></span>
                        <span>Cliente: <strong>
                                <?php echo $cliente->getNome() ?>
                            </strong></span>
                    </div>
                    <div class="divisor"></div>
                    <div class="pedido-body">
                        <h2>Equipamentos:</h2>
                        <div class="area-equip row justify-content-evenly">
                            <?php
                                    include_once "./components/componentes_pedidos.php";
                                    foreach ($pedido->getEquipamentos() as $equipamento) {
                                        getPedidoRestricted($equipamento->finalizado(), $equipamento->getModelo(), $equipamento->getTipo());
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
                                                <p>
                                                <form action="alterarTeste" method="post">
                                                    <input type="hidden" name="teste"
                                                        value="<?php echo $teste->getId() ?>">
                                                    <input type="hidden" name="equipamento"
                                                        value="<?php echo $equipamento->getId() ?>">
                                                    <button type="submit" class="btn <?php if ($teste->getStatus() == StatusTesteEnum::FINALIZADO) {
                                                                        echo 'btn-disabled';
                                                                    } else {
                                                                        echo 'btn-finalizar';
                                                                    } ?>" <?php if ($teste->getStatus() == StatusTesteEnum::FINALIZADO) {
                                                                         echo 'disabled';
                                                                     } ?>>Finalizar</button>
                                                </form>
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
                endforeach;
                ?>
            </div>
        </div>

    </div>
    <script src="../assets/scripts/pedido.js" defer></script>
</section>