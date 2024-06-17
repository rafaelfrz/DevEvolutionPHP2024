<?php

function verificarNumero($numero) {
    switch ($numero) {
        case $numero > 0:
            echo "O número é maior do que zero";
            break;
        case $numero < 0:
            echo "O número é menor do que zero";
            break;
        case $numero == 0:
            echo "O número é igual a zero";
            break;
    }
    echo "" . PHP_EOL;
    return;
}

$numero = readline("Digite um número: ");

verificaNumero($numero);