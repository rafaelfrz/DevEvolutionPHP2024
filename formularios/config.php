<?php

$db = new SQLite3('formularios.sqlite');

function autenticar()
{
    session_start();
    if (!$_SESSION['auth']) {
        header('Location: login.php?msg Faça login!');
        exit;
    }
}

?>