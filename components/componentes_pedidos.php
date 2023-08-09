<?php

function getPedido(bool $status, string $nome, int $tipo)
{

    if ($status === true) {
        $text = '<p><i class="fa-solid fa-circle-check"></i> Finalizado</p>';
        $class = 'finalizado';
    } else {
        $text = '<p><i class="fa-regular fa-circle"></i> Executando</p>';
        $class = 'em-and';
    }

    switch ($tipo) {
        case TipoEquipamentoEnum::COLETOR:
            $img = './assets/imgs/coletor.jpeg';
            break;
        case TipoEquipamentoEnum::RESERVATORIO:
            $img = './assets/imgs/reservatorio.png';
            break;
        case TipoEquipamentoEnum::MODULO:
            $img = './assets/imgs/modulo.png';
            break;
    }

    echo <<<HTML
        <div class="col-1 px-1 py-1 img-equip">
            <div class="imagem">
                <img class="w-100" src="{$img}" alt="">
            </div>
            <p>{$nome}</p>
            <div class="status-equip {$class}">
                {$text}
            </div>
        </div>
    HTML;

}

function getPedidoRestricted(bool $status, string $nome, int $tipo)
{

    if ($status === true) {
        $text = '<p><i class="fa-solid fa-circle-check"></i> Finalizado</p>';
        $class = 'finalizado';
    } else {
        $text = '<p><i class="fa-regular fa-circle"></i> Executando</p>';
        $class = 'em-and';
    }

    switch ($tipo) {
        case TipoEquipamentoEnum::COLETOR:
            $img = '../assets/imgs/coletor.jpeg';
            break;
        case TipoEquipamentoEnum::RESERVATORIO:
            $img = '../assets/imgs/reservatorio.png';
            break;
        case TipoEquipamentoEnum::MODULO:
            $img = '../assets/imgs/modulo.png';
            break;
    }

    echo <<<HTML
        <div class="col-1 px-1 py-1 img-equip">
            <div class="imagem">
                <img class="w-100" src="{$img}" alt="">
            </div>
            <p>{$nome}</p>
            <div class="status-equip {$class}">
                {$text}
            </div>
        </div>
    HTML;

}

function getImgPedido(int $tipo)
{
    switch ($tipo) {
        case TipoEquipamentoEnum::COLETOR:
            $img = '../assets/imgs/coletor.jpeg';
            break;
        case TipoEquipamentoEnum::RESERVATORIO:
            $img = '../assets/imgs/reservatorio.png';
            break;
        case TipoEquipamentoEnum::MODULO:
            $img = '../assets/imgs/modulo.png';
            break;
    }

    echo <<<HTML
            <div class="imagem col-2">
                <img class="w-100" src="{$img}" alt="">
            </div>
HTML;

}