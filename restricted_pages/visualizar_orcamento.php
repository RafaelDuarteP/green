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
                    <h2 class="col-12 text-center">
                        <span class="num-pedido">
                            nº:
                        </span>
                        #
                        <?php echo $pedido->getNumero(); ?>
                    </h2>
                    <h5 class="col-3">
                        Data:
                        <?php echo converterData($pedido->getData()); ?>
                    </h5>
                    <h5 class="col-2 text-center">
                        Total: R$
                        <?php echo converterNumeroFloat($pedido->getTotal()); ?>
                    </h5>
                    <div class="col-3">
                        Status:
                        <?php
                            include_once "./components/status_orcamento.php";
                            getStatus($pedido->getStatus());
                            ?>
                    </div>
                    <div class="row col-12 justify-content-around">
                        <?php
                            if ($pedido->getStatus() == StatusPedidoEnum::AGUARDANDO):
                                ?>
                        <button type="button" class="col-3  btn btn-baixar">
                            Aprovar
                        </button>
                        <?php
                            elseif ($pedido->getStatus() == StatusPedidoEnum::PENDENTE):
                                ?>
                        <button type="button" class="col-2  btn btn-assinar">
                            Solicitar assinatura
                        </button>
                        <button type="button" class="col-2  btn btn-cancelar">
                            Recusar
                        </button>
                        <?php
                            endif;
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Teste:</th>
                                    <th scope="col" class="col-6">Descrição:</th>
                                    <th scope="col">Valor:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        foreach ($equipamento->getTestes() as $teste):
                                            ?>
                                <tr>
                                    <td scope="row">
                                        <?php echo $teste->getNome(); ?>
                                    </td>
                                    <td>
                                        <?php echo $teste->getDescricao(); ?>
                                    </td>
                                    <td>R$
                                        <?php echo converterNumeroFloat($teste->getValor()); ?>
                                    </td>
                                </tr>
                                <?php
                                        endforeach;
                                        ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-end">
                                        <strong>Total:</strong>
                                    </th>
                                    <td>
                                        <strong>R$
                                            <?php echo converterNumeroFloat($equipamento->getTotalValorTestes()); ?>
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
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