<?php
require_once "./models/TipoEquipamento.php";
require_once "./connections/TesteDAO.php";
require_once "./models/Teste.php";
?>

<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/home.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/teste.css">
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


        <div class="col-9 ps-4 py-3">
            <div class="area-teste">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalNovo">Novo teste</button>
                <table class="table table-striped table-hover mb-5">
                    <caption>Testes em coletor</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $testeDAO = new TesteDAO();
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::COLETOR);
                        foreach ($testes as $teste):
                            ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $teste->getNome() ?>
                                </td>
                                <td>
                                    <?php echo $teste->getDescricao() ?>
                                </td>
                                <td>
                                    R$
                                    <?php echo converterNumeroFloat($teste->getValor()) ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <table class="table table-striped table-hover mb-5">
                    <caption>Testes em Reservatório</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $testeDAO = new TesteDAO();
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::RESERVATORIO);
                        foreach ($testes as $teste):
                            ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $teste->getNome() ?>
                                </td>
                                <td>
                                    <?php echo $teste->getDescricao() ?>
                                </td>
                                <td>
                                    R$
                                    <?php echo converterNumeroFloat($teste->getValor()) ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <table class="table table-striped table-hover mb-5">
                    <caption>Testes em Módulo Fotovoltaico</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $testeDAO = new TesteDAO();
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::MODULO);
                        foreach ($testes as $teste):
                            ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $teste->getNome() ?>
                                </td>
                                <td>
                                    <?php echo $teste->getDescricao() ?>
                                </td>
                                <td>
                                    R$
                                    <?php echo converterNumeroFloat($teste->getValor()) ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>

<div class="modal" tabindex="-1" id="modalNovo" aria-labelledby="modalNovoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="novoTeste" method="post" id="formNovo">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNovoLabel">Novo teste</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control" type="text" name="nome" id="nome" placeholder="nome" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="descricao">Descrição</label>
                            <input class="form-control" type="text" name="descricao" id="descricao"
                                placeholder="descrição" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="valor">Valor</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="valor" id="valor"
                                placeholder="0,00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="tipo">Tipo de equipamento</label>
                            <select class="form-select" name="tipo" id="tipo">
                                <option value="<?php echo TipoEquipamentoEnum::COLETOR ?>">COLETOR SOLAR</option>
                                <option value="<?php echo TipoEquipamentoEnum::RESERVATORIO ?>">RESERVATÓRIO TÉRMICO
                                </option>
                                <option value="<?php echo TipoEquipamentoEnum::MODULO ?>">MÓDULO FOTOVOLTAICO</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>