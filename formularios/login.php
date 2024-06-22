<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <form method="POST" action="auth.php">
        <label for="email">Email</label>
        <input type="email" name="email" required> <br>

        <label for="senha">Senha</label>
        <input type="password" name="senha" required> <br>

        <button type="submit">Entrar</button>

    </form>
    <?php
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</body>

</html>