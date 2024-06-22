<?php
require 'config.php';

$dadosNovos = array();
$dadosNovos = $_POST;

$params = $_GET;
$id = (int) $params['id'];

$dadosUsuario = array();
$dadosUsuario = $db->querySingle("SELECT * FROM usuarios WHERE id = {$id}", true);

//array(2) { ["name"]=> string(9) "dasdsadsa" 
//["email"]=> string(22) "rafael.ferraz@g1al.com" }

foreach($dadosNovos as $key => $dados) {
	if($dados == '' || $dados == null) {
		$dadosNovos[$key] =	$dadosUsuario[$key];
	}
}

$updateQuery = "UPDATE usuarios SET name = '{$dadosNovos['name']}', email = '{$dadosNovos['email']}' WHERE id = {$id};";
$res = $db->exec($updateQuery);

if ($res == false) {
	echo 'Erro ao atualizar usuário';
} else {
	header('Location: index.php');
}

?>