<?php
    $cidades = [
        'SC' => [
            'Chapecó',
            'Florianópolis',
            'Concórdia',
            'Xaxim'
        ],
        'PR' => [
            'Pato Branco',
            'Francisco Beltrão',
            'Curitiba',
            'Maringá'
        ]
    ];

    foreach($cidades as $estadao => $cidade) {
        echo 'Sigla do Estado: ' . $estado . PHP_EOL;

        foreach($cidade as $nome) {
            echo 'Cidade: ' . $nome . PHP_EOL;
        }
    }