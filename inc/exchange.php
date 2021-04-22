<?php

//Verifica se a moeda é valida para a API
$currencyValidate = fn($val) => $val == 'BRL' || $val == 'brl' || $val == 'USD' || $val == 'usd' || $val == 'EUR' || $val == 'eur' ? true : false;

//Realiza o cálculo de conversão
$convertedValue = fn($valAmount, $valPrice) => floatval($valAmount) * floatval($valPrice);

//Converte texto para uppercase
$valToUppercase = fn($val) => strtoupper($val);

//Retorna o símbolo da moeda
$currencySimbol = function ($val){
    switch ($val) {
        case 'BRL':
            return 'R$';
            break;
        case 'USD':
            return '$';
            break;
        case 'EUR':
            return '€';
            break;
        default:
            return false;
            break;
    }
}

?>