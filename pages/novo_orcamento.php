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
    clone.querySelector('.titulo-equipamento').innerHTML = "Equipamento #" + (lastAdd + 1) + ":";
    clone.querySelector(".nome input").value = "";
    clone.querySelector(".descricao input").value = "";
    clone.querySelector(".tipo select").value = 1;
    clone.querySelectorAll("input[name='testes[0][]']").forEach(e => {
        e.checked = false;
        e.name = "testes[" + lastAdd + "][]";
    });

    var form = document.querySelector("form");
    form.insertBefore(clone, form.querySelector(".area-botao"));
}
</script>

<section class="container-fluid px-4">
    <div class="row h-100 justify-content-evenly">
        <?php
        include_once "./components/sidebar.php";
        getSideBar($user, 2);
        ?>

        <div class="col-9 form-orcamento">
            <form action="controller/novo-orcamento" method="post">
                <h2 class="text-center">Novo Orçamento</h2>
                <div class="equipamento row justify-content-center mt-3">
                    <h3 class="titulo-equipamento">Equipamento #1:</h3>
                    <div class="nome col-9 mt-2">
                        <label class="form-label" for="nome">Modelo:</label>
                        <input class="form-control" type="text" name="nome[]" id="nome">
                    </div>
                    <div class="descricao col-5 mt-2">
                        <label class="form-label" for="descricao">Características:</label>
                        <input class="form-control" type="text" name="descricao[]" id="descricao">
                    </div>
                    <div class="tipo col-4 mt-2">
                        <label class="form-label" for="tipo">Tipo do equipamento:</label>
                        <select class="form-select" name="tipo[]" id="tipo">
                            <option value="<?php echo TipoEquipamentoEnum::COLETOR ?>">COLETOR SOLAR</option>
                            <option value="<?php echo TipoEquipamentoEnum::RESERVATORIO ?>">RESERVATÓRIO TÉRMICO
                            </option>
                            <option value="<?php echo TipoEquipamentoEnum::MODULO ?>">MÓDULO FOTOVOLTAICO</option>
                        </select>
                    </div>
                    <div class="testes col-9 mt-2">
                        <label class="form-label">Testes:</label>
                        <div class="row">
                            <div class="col-4 checks-teste">
                                <p>Testes em coletor:</p>
                                <?php
                                $testeDAO = new TesteDAO();
                                $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::COLETOR);
                                foreach ($testes as $teste):
                                    ?>
                                <label class="form-label">
                                    <input class="form-check-input" type="checkbox" name="testes[0][]"
                                        value="<?php echo $teste->getId() ?>">
                                    <?php echo $teste->getNome(); ?>
                                </label>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="col-4 checks-teste">
                                <p>Testes em Reservatório:</p>
                                <?php
                                $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::RESERVATORIO);
                                foreach ($testes as $teste):
                                    ?>
                                <label class="form-label">
                                    <input class="form-check-input" type="checkbox" name="testes[0][]"
                                        value="<?php echo $teste->getId() ?>">
                                    <?php echo $teste->getNome(); ?>
                                </label>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="col-4 checks-teste">
                                <p>Testes em Módulo Fotovoltaico:</p>
                                <?php
                                $testes = $testeDAO->findByTipo(TipoEquipamentoEnum::MODULO);
                                foreach ($testes as $teste):
                                    ?>
                                <label class="form-label">
                                    <input class="form-check-input" type="checkbox" name="testes[0][]"
                                        value="<?php echo $teste->getId() ?>">
                                    <?php echo $teste->getNome(); ?>
                                </label>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end area-botao">
                    <button class="btn col-3" type="button" onclick="addEquipamento()">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar equipamento
                    </button>
                </div>
                <div class="row justify-content-center area-botao-enviar mt-3">
                    <button class="btn-finalizar col-9" type="submit">Finalizar</button>
                </div>

            </form>
        </div>
    </div>
</section>