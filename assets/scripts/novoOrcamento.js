var lastAdd = 0;

function addEquipamento() {
    lastAdd++;
    let equipamento = document.querySelector(".equipamento");
    let clone = equipamento.cloneNode(true);
    clone.querySelector('.titulo-equipamento').innerHTML = "Equipamento #" + (lastAdd + 1) + ":";
    clone.querySelector(".nome input").value = "";
    clone.querySelector(".descricao textarea").value = "";
    clone.querySelector(".tipo select").value = 1;
    clone.querySelectorAll("input[name='testes[0][]']").forEach(e => {
        e.checked = false;
        e.name = "testes[" + lastAdd + "][]";
    });

    var form = document.querySelector("form");
    form.insertBefore(clone, form.querySelector(".area-botao"));
}