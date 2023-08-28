$(document).ready(function () {
    $('#formAtualizarSenha').on('submit', function (event) {
        event.preventDefault();
        if (confirm('Tem certeza de que deseja alterar a senha? \n Esta ação feita de forma incorreta pode causar falha de funcionamento do sistema!')) {
            this.submit();
        }
    });
});