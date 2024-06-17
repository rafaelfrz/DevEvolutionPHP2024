<?php
//$array = [ ] => iniciando um array
//vardump => printando os dados do array
//pop
//unset => remove elemento do array
$array = [];

for($i = 0; $i < 3; $i++) {
    $numero = readline("Digite um número: ");
    array_push($array,$numero);
}

var_dump($array);


?>