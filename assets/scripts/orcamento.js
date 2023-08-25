$(document).ready(function () {
    $('#baixar').click(function () {
        $('.orcamento').printThis({
            importCSS: true,
            pageTitle: "Orçamento",
            header: "<h1 class='col-12 text-center'>Orçamento</h1>",
            canvas: true,
            removeScripts: true,
            copyTagClasses: true,
        });
    });
});