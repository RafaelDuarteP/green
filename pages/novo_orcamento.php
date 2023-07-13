<?php
require_once "./models/TipoEquipamento.php";
require_once "./connections/TesteDAO.php";
require_once "./models/Teste.php";

?>

<link rel="stylesheet" href="./assets/styles/home.css">
<link rel="stylesheet" href="./assets/styles/orcamento.css">
<title>Novo Orçamento</title>


<?php
include_once "./components/header.php";
?>

<script>
    var lastAdd = 0;

    function addEquipamento() {
        lastAdd++;
        let equipamento = document.querySelector(".equipamento");
        let clone = equipamento.cloneNode(true);
        clone.querySelector(".nome input").value = "";
        clone.querySelector(".descricao input").value = "";
        clone.querySelector(".tipo select").value = "COLETOR";
        clone.querySelectorAll("input[name='testes[0][]']").forEach(e => {
            e.checked = false;
            e.name = "testes[" + lastAdd + "][]";
        });

        var form = document.querySelector("form");
        form.insertBefore(clone, form.querySelector("#adicionarButton"));
    }
</script>

<section class="container-fluid px-4">
    <div class="row h-100">
        <?php
        include_once "./components/sidebar.php";
        getSideBar($user, 2);
        ?>

        <div class="col-9 form-orcamento">
            <form action="controller/novo-orcamento" method="post">
                <div class="equipamento">
                    <div class="nome">
                        <label for="nome">Nome Equipamento</label>
                        <input type="text" name="nome[]" id="nome">
                    </div>
                    <div class="descricao">
                        <label for="descricao">Descrição do equipamento</label>
                        <input type="text" name="descricao[]" id="descricao">
                    </div>
                    <div class="tipo">
                        <label for="tipo">Tipo do equipamento</label>
                        <select name="tipo[]" id="tipo">
                            <option value="<?php echo TipoEquipamentoEnum::COLETOR ?>">COLETOR</option>
                            <option value="<?php echo TipoEquipamentoEnum::MODULO ?>">MÓDULO FOTOVOLTAICO</option>
                            <option value="<?php echo TipoEquipamentoEnum::RESERVATORIO ?>">RESERVATÓRIO</option>
                        </select>
                    </div>
                    <div class="testes">
                        <div>Testes em coletor:</div>
                        <?php
                        $testeDAO = new TesteDAO();
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::COLETOR);
                        foreach ($testes as $teste):
                            ?>
                            <label>
                                <input type="checkbox" name="testes[0][]" value="<?php echo $teste->getId() ?>">
                                <?php echo $teste->getNome(); ?>
                            </label>
                            <?php
                        endforeach;
                        ?>
                        <div>Testes em Reservatório:</div>
                        <?php
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::RESERVATORIO);
                        foreach ($testes as $teste):
                            ?>
                            <label>
                                <input type="checkbox" name="testes[0][]" value="<?php echo $teste->getId() ?>">
                                <?php echo $teste->getNome(); ?>
                            </label>
                            <?php
                        endforeach;
                        ?>
                        <div>Testes em Módulo Fotovoltaico:</div>
                        <?php
                        $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::MODULO);
                        foreach ($testes as $teste):
                            ?>
                            <label>
                                <input type="checkbox" name="testes[0][]" value="<?php echo $teste->getId() ?>">
                                <?php echo $teste->getNome(); ?>
                            </label>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <button type="button" onclick="addEquipamento()" id="adicionarButton"><i class="fa-solid fa-plus"></i>
                    Adicionar
                    equipamento</button>
                <button type="submit">finalizar</button>
            </form>
        </div>
    </div>
</section>