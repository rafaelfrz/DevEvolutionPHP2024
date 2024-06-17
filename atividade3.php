<?php

function verificaIntervalo($numero) {
    if ($numero >= 10 && $numero <= 20) {
        echo "O número se encontra dentro do intervalo";
    } else {
        echo "O número se encontra fora do intervalo";
    }

    echo "" . PHP_EOL;
}

$numero = readline("Digite um valor para verificar se ele se encontra dentro do intervalo de 10 à 20: ");

verificaIntervalo($numero);