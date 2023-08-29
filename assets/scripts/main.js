$(document).ready(function () {

    if (!navigator.cookieEnabled) {
        $("#cookie").show();

    }
    else { $("#cookie").hide(); }

});