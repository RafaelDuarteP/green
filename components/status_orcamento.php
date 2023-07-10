<?php

require_once 'models/StatusPedido.php';


function getStatus($status)
{
    switch ($status) {
        case StatusPedidoEnum::APROVADO:
            echo <<<HTML
            <div class="status-card">
                <div class="icon aprovado"><i class="fa-solid fa-check"></i></div>
                <p class="caption aprovado"> Aprovado</p>
            </div>
        HTML;
            break;

        case StatusPedidoEnum::AGUARDANDO:
            echo <<<HTML
            <div class="status-card">
                <div class="icon aguardando"><i class="fa-solid fa-pause"></i></div>
                <p class="caption aguardando"> Aguardando assinatura</p>
            </div>
        HTML;
            break;
        case StatusPedidoEnum::PENDENTE:
            echo <<<HTML
                <div class="status-card">
                    <div class="icon pendente"><i class="fa-solid fa-ellipsis"></i></div>
                    <p class="caption pendente"> Pendente</p>
                </div>
            HTML;
            break;
        case StatusPedidoEnum::CANCELADO:
            echo <<<HTML
                <div class="status-card">
                    <div class="icon cancelado"><i class="fa-solid fa-times"></i></div>
                    <p class="caption cancelado"> Cancelado</p>
                </div>
            HTML;
            break;
    }


}