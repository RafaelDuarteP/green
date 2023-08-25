<?php
require_once './connections/ClienteDAO.php';
require_once './connections/PedidoDAO.php';
require_once './models/Cliente.php';
?>

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

        <div class="col-9 area-orcamentos">
            <div class="row justify-content-center">
                <div class="col-12 area-sup">
                    <div class="row justify-content-between py-3">
                        <h2 class="col-3">Orçamentos</h2>
                    </div>
                </div>

                <?php
                $clienteDAO = new ClienteDAO();
                $clientes = $clienteDAO->findAll();

                foreach ($clientes as $cliente):
                    $pedidoDAO = new PedidoDAO();
                    $pedidos = $pedidoDAO->findOrcamentoByCliente($cliente->getId());
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
                            <div></div>
                            <p>valor: R$ <span>
                                    <?php echo converterNumeroFloat($pedido->getTotal()) ?>
                                </span> </p>
                            <p>qtd equipamentos: <span>
                                    <?php echo count($pedido->getEquipamentos()) ?>
                                </span> </p>
                            <a href="orcamento?id=<?php echo $pedido->getId() ?>" class="btn btn-baixar">Visualizar</a>
                            <p>Cliente: <span>
                                    <?php echo $cliente->getNome() ?>
                                </span> </p>
                            <p>Contato: <span>
                                    <a href="mailto:<?php echo $cliente->getEmail() ?>"><?php echo $cliente->getEmail() ?></a>
                                </span> </p>
                            <div></div>
                        </div>

                        <?php
                    endforeach;
                endforeach;
                ?>
            </div>

        </div>
    </div>
</section>