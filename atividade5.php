<?php

/*
    array_shift => remove o item na primeira posição
    array_unshift => insere item na primeira posição
    array_push => insere o item na última posição
    array_pop => remove o item da última posição
*/

function listarCidades(array $cidades) {
    foreach($cidades as $cidade) {
        echo $cidade . PHP_EOL;
    }
}

$cidades = [];

while(true) {
    $cidade = readline('Escreva um município: ');

    array_push($cidades,$cidade);
    // $cidades[] = $cidade;
    // $cidades[] =readline('Escreva um município: ');
}

listarCidades($cidades);