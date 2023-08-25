<?php
require_once "./connections/PedidoDAO.php";
?>

<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/orcamento.css">
<title>Orçamentos</title>


<?php
include_once "./components/header.php";
?>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBar($user, 2);
        ?>

        <div class="col-9 area-orcamentos">
            <div class="row justify-content-center">
                <div class="col-12 area-sup">
                    <div class="row justify-content-between py-3">
                        <h2 class="col-3">Orçamentos ativos</h2>
                        <a href="novo-orcamento" class="col-2 btn-novo"> <i class="fa-solid fa-plus"></i> Novo
                            orçamento</a>
                    </div>
                </div>

                <?php
                $pedidoDAO = new PedidoDAO();
                $pedidos = $pedidoDAO->findOrcamentoByCliente($user->getId());

                foreach ($pedidos as $pedido):
                    ?>

                    <div class="card-orcamento col-10 mt-3">
                        <p>n°: <span>
                                <?php echo $pedido->getNumero() ?>
                            </span> </p>
                        <div>status:
                            <?php
                            include_once "./components/status_orcamento.php";
                            getStatus($pedido->getStatus());
                            ?>
                        </div>
                        <button class="btn-baixar">Baixar</button>
                        <p>valor: R$ <span>
                                <?php echo converterNumeroFloat($pedido->getTotal()) ?>
                            </span> </p>
                        <p>qtd equipamentos: <span>
                                <?php echo count($pedido->getEquipamentos()) ?>
                            </span> </p>
                        <button class="btn-disabled">Cancelar</button>
                    </div>

                    <?php
                endforeach;
                ?>

            </div>
        </div>
    </div>
</section>