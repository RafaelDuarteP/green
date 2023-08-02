<?php

function converterData($data)
{
    // Converte a data para o formato do PHP (YYYY-MM-DD para Y-m-d)
    $dataFormatoPHP = date("Y-m-d", strtotime($data));

    // Converte a data para o formato desejado (Y-m-d para d/m/Y)
    $dataFormatoDesejado = date("d/m/Y", strtotime($dataFormatoPHP));

    return $dataFormatoDesejado;
}

function converterDataHora($dataHora)
{
    // Converte a data e hora para o formato do PHP (YYYY-MM-DD HH:MM:SS para Y-m-d H:i:s)
    $dataHoraFormatoPHP = date("Y-m-d H:i:s", strtotime($dataHora));

    // Converte a data e hora para o formato desejado (Y-m-d H:i:s para d/m/Y H:i:s)
    $dataHoraFormatoDesejado = date("d/m/Y H:i:s", strtotime($dataHoraFormatoPHP));

    return $dataHoraFormatoDesejado;
}

function converterNumeroFloat($numero)
{
    // Converte o número float para o formato desejado
    $numeroFormatado = number_format($numero, 2, ',', '.');

    return $numeroFormatado;
}