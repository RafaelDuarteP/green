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

function formatarCnpj($cnpj)
{
    // Remove quaisquer caracteres não numéricos do CNPJ original
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

    // Formatação do CNPJ: XX.XXX.XXX/YYYY-ZZ
    // Onde X representa os 8 primeiros dígitos e YZ representa os 4 últimos dígitos
    $formattedCnpj = substr($cnpj, 0, 2) . '.' .
        substr($cnpj, 2, 3) . '.' .
        substr($cnpj, 5, 3) . '/' .
        substr($cnpj, 8, 4) . '-' .
        substr($cnpj, 12, 2);

    return $formattedCnpj;
}