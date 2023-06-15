$(document).ready(function () {

    function updateTimeline($componente) {
        let quantidade = $componente.find('ul.progress-list li.step').length;
        let quantidadeActive = $componente.find('ul.progress-list li.active').length;
        let percentage = 100 / quantidade;
        let progress = percentage * quantidadeActive;

        $componente.find('.progress-bar-container li').css('width', percentage + '%');
        $componente.find('.progress-bar-container .line-progress').css('width', progress + '%');
    }



    $('.img-equip').each(function (index) {
        $(this).on('click', function () {
            $('.img-equip').toggleClass('selected', false);
            $(this).toggleClass('selected', true);
            $('.detail').each(function (i) {
                $(this).toggleClass('d-none', true);
                if (i === index) {
                    $(this).toggleClass('d-none', false);
                    updateTimeline($(this));
                }
            });
        });
    });




})