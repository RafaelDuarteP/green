<?php
require_once './connections/ClienteDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';
require_once './models/StatusPedido.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ./orcamentos');
    exit;
}

$id = intval($id);

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
    integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/orcamento.css">
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
                    <div class="voltar">
                        <button type="button" onclick="window.history.back()">
                            <i class="fa-solid fa-chevron-left"></i> voltar
                        </button>
                    </div>
                    <h2 class="col-12 text-center">
                        <span class="num-pedido">
                            nº:
                        </span>
                        #
                        <?php echo $pedido->getNumero(); ?>
                    </h2>
                    <h4 class="col-12 text-center">
                        Cliente:
                        <?php
                            $clienteDAO = new ClienteDAO();
                            $cliente = $clienteDAO->findById($pedido->getIdCliente());
                            echo $cliente->getNome();
                            ?>
                    </h4>
                    <h5 class="col">
                        Data:
                        <?php echo converterData($pedido->getData()); ?>
                    </h5>
                    <h5 class="col text-center">
                        Total: R$
                        <?php echo converterNumeroFloat($pedido->getTotal()); ?>
                    </h5>
                    <div class="col-4 text-end">
                        Status:
                        <?php
                            include_once "./components/status_orcamento.php";
                            getStatus($pedido->getStatus());
                            ?>
                    </div>
                    <div class="col-12 row justify-content-around mt-2">
                        <?php
                            if ($pedido->getStatus() == StatusPedidoEnum::AGUARDANDO):
                                ?>

                        <form action="<?php echo BASE_URL ?>restricted/alterarStatusPedido" method="post" class="col-3">
                            <input type="hidden" name="id" value="<?php echo $pedido->getId() ?>">
                            <input type="hidden" name="status" value="<?php echo StatusPedidoEnum::APROVADO ?>">
                            <button type="submit" class="col-12 btn btn-baixar">
                                Aprovar
                            </button>
                        </form>
                        <?php
                            elseif ($pedido->getStatus() == StatusPedidoEnum::PENDENTE):
                                ?>

                        <form action="<?php echo BASE_URL ?>restricted/alterarStatusPedido" method="post" class="col-3">
                            <input type="hidden" name="id" value="<?php echo $pedido->getId() ?>">
                            <input type="hidden" name="status" value="<?php echo StatusPedidoEnum::AGUARDANDO ?>">
                            <button type="submit" class="col-12 btn btn-assinar">
                                Solicitar assinatura
                            </button>
                        </form>

                        <form action="<?php echo BASE_URL ?>restricted/alterarStatusPedido" method="post" class="col-3">
                            <input type="hidden" name="id" value="<?php echo $pedido->getId() ?>">
                            <input type="hidden" name="status" value="<?php echo StatusPedidoEnum::CANCELADO ?>">
                            <button type="submit" class="col-12 btn btn-cancelar">
                                Recusar
                            </button>
                        </form>
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
                        Descrição:</br> <strong>
                            <?php echo nl2br($equipamento->getDescricao()); ?>
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

                <h2 class="col-12 mb-2 text-center">
                    Total: R$
                    <?php echo converterNumeroFloat($pedido->getTotal()); ?>
                </h2>

                <button id="baixar" type="button" class="col-3 btn mt-5 btn-baixar">
                    <i class="fa-solid fa-download"></i> Baixar
                </button>
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

<script language="JavaScript" type="text/javascript" src="<?php echo BASE_URL ?>assets/scripts/orcamento.js" defer>
</script>