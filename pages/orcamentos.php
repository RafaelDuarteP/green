<link rel="stylesheet" href="./assets/styles/home.css">
<link rel="stylesheet" href="./assets/styles/orcamento.css">
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
                        <button class="col-2 btn-novo"> <i class="fa-solid fa-plus"></i> Novo orçamento</button>
                    </div>
                </div>

                <div class="card-orcamento col-10 mt-3">
                    <p>n°: <span>12345</span> </p>
                    <div>status:
                        <?php
                        include_once "./components/status_orcamento.php";
                        getStatus(StatusPedidoEnum::CANCELADO);
                        ?>
                    </div>
                    <button class="btn-baixar">Baixar</button>
                    <p>valor: R$ <span>10.000,00</span> </p>
                    <p>qtd equipamentos: <span>5</span> </p>
                    <button class="btn-disabled">Cancelar</button>
                </div>
                <div class="card-orcamento col-10 mt-3">
                    <p>n°: <span>12345</span> </p>
                    <div>status:
                        <?php
                        include_once "./components/status_orcamento.php";
                        getStatus(StatusPedidoEnum::APROVADO);
                        ?>
                    </div>
                    <button class="btn-baixar">Baixar</button>
                    <p>valor: R$ <span>10.000,00</span> </p>
                    <p>qtd equipamentos: <span>5</span> </p>
                    <button class="btn-disabled">Cancelar</button>
                </div>
                <div class="card-orcamento col-10 mt-3">
                    <p>n°: <span>12345</span> </p>
                    <div>status:
                        <?php
                        include_once "./components/status_orcamento.php";
                        getStatus(StatusPedidoEnum::AGUARDANDO);
                        ?>
                    </div>
                    <button class="btn-baixar">Baixar</button>
                    <p>valor: R$ <span>10.000,00</span> </p>
                    <p>qtd equipamentos: <span>5</span> </p>
                    <button class="btn-disabled">Cancelar</button>
                </div>
                <div class="card-orcamento col-10 mt-3">
                    <p>n°: <span>12345</span> </p>
                    <div>status:
                        <?php
                        include_once "./components/status_orcamento.php";
                        getStatus(StatusPedidoEnum::PENDENTE);
                        ?>
                    </div>
                    <button class="btn-baixar">Baixar</button>
                    <p>valor: R$ <span>10.000,00</span> </p>
                    <p>qtd equipamentos: <span>5</span> </p>
                    <button class="btn-disabled">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</section>