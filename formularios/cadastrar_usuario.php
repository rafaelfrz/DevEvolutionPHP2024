<?php
require 'config.php';

$cadastroPost = array();
$cadastroPost[] = $_POST;

$name = $cadastroPost[0]['name'];
$email = $cadastroPost[0]['email'];
$password = $cadastroPost[0]['password'];
$password = password_hash($password, PASSWORD_DEFAULT);
$createdAt = date("Y-m-d H:i:s");

$stmt = $db->prepare('INSERT INTO usuarios (name, email, password, createdAt) VALUES (:name, :email, :password, :createdAt)');
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->bindValue(':createdAt', $createdAt);

$res = $stmt->execute();

if (!$res) {
    echo 'Falha ao cadastrar usuário';
} else {
    header('Location: index.php');
}

?>