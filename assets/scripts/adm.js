$(document).ready(function () {
    $("#senha").on("input", function () {
        if ($("#senha").val().length < 8) {
            $("#senha").addClass("error");
            $("#label-senha").addClass("error-message");
            $("#error-message-senha").removeClass("d-none");
        } else {
            $("#senha").removeClass("error");
            $("#label-senha").removeClass("error-message");
            $("#error-message-senha").addClass("d-none");
        }
    });

    // Verifica a igualdade das senhas quando as entradas mudam
    $("#senha, #confirmarSenha").on("input", function () {
        if ($("#senha").val() == $("#confirmarSenha").val()) {
            $("#confirmarSenha").removeClass("error");
            $("#label-confirma").removeClass("error-message");
            $("#error-message").addClass("d-none");
        } else {
            $("#confirmarSenha").addClass("error");
            $("#label-confirma").addClass("error-message");
            $("#error-message").removeClass("d-none");
        }
    });

    $("#formNovoADM").submit(function (e) {
        if ($("#senha").val().length < 8) {
            alert("Sua senha precisa ter ao menos 8 caracteres");
            e.preventDefault();
        } else if ($("#senha").val() != $("#confirmarSenha").val()) {
            alert("As senhas não correspondem!");
            e.preventDefault();
        }
    });

});