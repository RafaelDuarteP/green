<?php

use function PHPSTORM_META\type;

require_once './connections/ClienteDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ./orcamentos');
    exit;
}

$id = intval($id);

?>

<link rel="stylesheet" href="../assets/styles/home.css">
<link rel="stylesheet" href="../assets/styles/orcamento.css">
<title>ACESSO RESTRITO | Orçamentos</title>

<?php
include_once "./components/header_restricted.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBarRestricted(2);
        ?>


        <div class="col-9 area-orcamentos ps-4 py-2">
            <div class="orcamento row justify-content-center">
                <?php
                $pedidoDAO = new PedidoDAO();
                $pedido = $pedidoDAO->findById($id);
                if ($pedido):
                    ?>
                    <div class="row justify-content-between header-orcamento">
                        <p class="col-2">
                            Numero:
                            <span class="num-pedido">
                                <?php echo $pedido->getNumero(); ?>
                            </span>
                        </p>
                        <p class="col-2">
                            Data:
                            <?php echo converterData($pedido->getData()); ?>
                        </p>
                        <p class="col-2">
                            Total: R$
                            <?php echo converterNumeroFloat($pedido->getTotal()); ?>
                        </p>
                        <div class="col-2">
                            Status:
                            <?php
                            include_once "./components/status_orcamento.php";
                            getStatus($pedido->getStatus());
                            ?>
                        </div>
                    </div>
                    <?php
                    foreach ($pedido->getEquipamentos() as $equipamento):
                        ?>
                        <div class="row col-10 equipamentos justify-content-center mt-4">
                            <h3 class="col-12 text-center">
                                Modelo: <strong>
                                    <?php echo $equipamento->getModelo(); ?>
                                </strong>
                            </h3>
                            <?php
                            require_once './components/componentes_pedidos.php';
                            getImgPedido($equipamento->getTipo());
                            ?>
                            <p class="col-12 text-center">
                                Descrição: <strong>
                                    <?php echo $equipamento->getDescricao(); ?>
                                </strong>
                            </p>
                            <h4 class="col-12 text-center">
                                Testes:
                            </h4>
                            <div class="col-8">
                                <div class="row testes justify-content-between">
                                    <h5 class="col-4">
                                        Teste:
                                    </h5>
                                    <h5 class="col-6 text-center">
                                        Descrição:
                                    </h5>
                                    <h5 class="col-2">
                                        Valor:
                                    </h5>
                                </div>
                                <?php
                                foreach ($equipamento->getTestes() as $teste):
                                    ?>
                                    <div class="row testes justify-content-between">
                                        <p class="col-4">
                                            <?php echo $teste->getNome(); ?>
                                        </p>
                                        <p class="col-3">
                                            <?php echo $teste->getDescricao(); ?>
                                        </p>
                                        <p class="col-2">
                                            R$
                                            <?php echo converterNumeroFloat($teste->getValor()); ?>
                                        </p>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>

                    <h2 class="col-12 text-center">
                        Total: R$
                        <?php echo converterNumeroFloat($pedido->getTotal()); ?>
                    </h2>
                    <?php
                else:
                    ?>
                    <h3 class="col-12 text-center">
                        Orçamento não encontrado
                    </h3>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>


</section>