<?php
require 'config.php';

$params = $_GET;
$id = $params['id'];


$res = $db->exec("DELETE FROM usuarios WHERE id = {$id}");

if ($res == false) {
	echo 'Falha ao apagar usuário';
} else {
	header('Location: index.php');
}
?>