<?php

function calcularMedia($numero1,$numero2,$numero3) {
    // TODO - Implementar lógica

    return $media = ($numero1 + $numero2 + $numero3) / 3;
}

$numero1 = readline("Nota 1: ");
$numero2 = readline("Nota 2: ");
$numero3 = readline("Nota 3: ");

$numero1 = intval($numero1);
$numero2 = intval($numero2);
$numero3 = intval($numero3);

$media = calcularMedia($numero1,$numero2,$numero3);

echo "Media do aluno: $media" . PHP_EOL;