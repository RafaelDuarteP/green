$(document).ready(function () {
    $('#login').mask('A', {
        translation: {
            'A': { pattern: /[\w@\-.+]/, recursive: true }
        }
    });
    $('#login').on('input', function () {
        var valor = $(this).cleanVal();
        var val = $(this).val().length;
        let regex = /^[0-9]*$/;
        if (valor.length == 14 && regex.test(valor)) {
            $(this).mask('00.000.000/0000-00', { reverse: true });
        } else {
            $(this).unmask();
            $(this).mask('A', {
                translation: {
                    'A': { pattern: /[\w@\-.+]/, recursive: true }
                }
            });
        }
        $(this)[0].setSelectionRange(val, val);
    }).trigger('input');
})