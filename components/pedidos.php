<?php

function getPedido(bool $status)
{

    if ($status === true) {
        $text = '<p><i class="fa-solid fa-circle-check"></i> Finalizado</p>';
        $class = 'finalizado';
    } else {
        $text = '<p><i class="fa-regular fa-circle"></i> Executando</p>';
        $class = 'em-and';
    }

    echo <<<HTML
        <div class="col-1 px-1 py-1 img-equip">
            <img class="w-100" src="./assets/imgs/placeholder.png" alt="">
            <p>Equipamento x</p>
            <div class="status-equip {$class}">
                {$text}
            </div>
        </div>
    HTML;

}