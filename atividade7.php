<?php

$estudantes = [
    0 => ['nome' => 'Rafael', 'idade' => 21, 'nota' => 6.75],
    1 => ['nome' => 'Ronan', 'idade' => 20, 'nota' => 9.0],
    2 => ['nome' => 'João', 'idade' => 19, 'nota' => 10.0],
    3 => ['nome' => 'Leonidas', 'idade' => 20, 'nota' => 6.9],
    4 => ['nome' => 'Oss', 'idade' => 20, 'nota' => 5.8]
];

$estudantesAprovados = [];

foreach($estudantes as $estudante) { 
    if($estudante['nota'] > 7) {
        $estudante['nome'] = strtoupper($estudante['nome']);
        array_push($estudantesAprovados,$estudante);
    }
}

foreach($estudantesAprovados as $estudante) {
    echo $estudante['nome'] . PHP_EOL;
}