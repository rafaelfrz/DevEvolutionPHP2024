<?php

function escolherMes(array $meses, int $mesRead) {
    if (array_key_exists($mesRead,$meses)) {
        echo $meses[$mesRead]['mes'] . ' é o ' . $mesRead + 1 . '° mês e possui ' . $meses[$mesRead]['dias'] . ' dias.' . PHP_EOL;
    }
}

$meses = [
    0 => ['mes' => 'Janeiro','dias' => 31],
    1 => ['mes' => 'Fevereiro','dias' => 28],
    2 => ['mes' => 'Março','dias' => 31],
    3 => ['mes' => 'Abril','dias' => 30],
    4 => ['mes' => 'Maio','dias' => 31],
    5 => ['mes' => 'Junho','dias' => 30],
    6 => ['mes' => 'Julho','dias' => 31],
    7 => ['mes' => 'Agosto','dias' => 31],
    8 => ['mes' => 'Setembro','dias' => 30],
    9 => ['mes' => 'Outubro','dias' => 31],
    10 => ['mes' => 'Novembro','dias' => 30],
    11 => ['mes' => 'Dezembro','dias' => 31]
];

echo 'Escolha um mês para obter mais informações: ' . PHP_EOL;

foreach($meses as $key => $mes) {
    $key += 1;
    echo '['. $key .'] - ' . $mes['mes'] . PHP_EOL; 
}

$mesEscolha = intval(readline('Mês: ') - 1);

escolherMes($meses, $mesEscolha);