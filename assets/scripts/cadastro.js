$(document).ready(function () {
    // Impede o envio do formulário
    $("#form-cadastro").submit(function (e) {
        let formPreenchido = true;
        $('#form-cadastro input').slice(0, -1).each(function () {
            console.log($(this).val())
            if ($(this).val() === '') {
                formPreenchido = false;
                return false; // Para o loop
            }
        });

        if (!formPreenchido) {
            alert('Preencha todos os campos do formulário.');
            e.preventDefault();
        } else if ($("#senha").val().length < 8) {
            alert("Sua senha precisa ter ao menos 8 caracteres");
            e.preventDefault();
        } else if ($("#senha").val() != $("#senha_confirma").val()) {
            alert("As senhas não correspondem!");
            e.preventDefault();
        }
        else if (!$('#termo').is(':checked')) {
            alert('Você deve aceitar os termos de uso e de privacidade');
            e.preventDefault();
        }
    });

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
    $("#senha, #senha_confirma").on("input", function () {
        if ($("#senha").val() == $("#senha_confirma").val()) {
            $("#senha_confirma").removeClass("error");
            $("#label-confirma").removeClass("error-message");
            $("#error-message").addClass("d-none");
        } else {
            $("#senha_confirma").addClass("error");
            $("#label-confirma").addClass("error-message");
            $("#error-message").removeClass("d-none");
        }
    });



});