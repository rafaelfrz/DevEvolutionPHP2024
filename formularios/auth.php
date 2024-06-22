<?php

require 'config.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$usuario = array();
$usuario = $db->querySingle("SELECT name,email,password FROM usuarios WHERE email = '{$_POST['email']}';", true);

if ($usuario == NULL) {
    $erroUsuario = 'Usuário não encontrado';
    header("Location: login.php?msg={$erroUsuario}");
    exit;
} else {
    $senhaCorreta = password_verify($senha,$usuario['password']);
    if ($senhaCorreta == false) {
        $erroSenha = 'Senha incorreta';
        header("Location: login.php?msg={$erroSenha}");
    } else {
        session_start();
        $_SESSION['name'] = $usuario['name'];
        $_SESSION['email'] = $usuario['password'];
        $_SESSION['auth'] = true;
        header('Location: index.php');
    }
}

?>