<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <!-- ATUALIZAR/EDITAR USUÁRIO -->
    <h1>Formulário de atualização</h1>
    
    <?php
        require 'config.php';

        $params = $_GET;
        $id = (int) $params['id'];

        echo "<form action=\"atualizar_usuario.php?id=$id\" method=\"POST\">";
    ?>
        <table>
            <tr>
                <th>Campos</th>
                <th>Atuais</th>
                <th>Novos</th>
            </tr>
            <?php


            $usuario = array();
            $usuario = $db->querySingle("SELECT * FROM usuarios WHERE id = {$id}", true);

            echo <<<END
                <tr>
                    <td>
                        Nome
                    </td>
                    <td>
                        <input value={$usuario['name']} readonly></input>
                    </td>
                    <td>
                        <input type="text" name="name"/> 
                    </td>
                </tr>
                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input value={$usuario['email']} readonly/>
                    </td>
                    <td>
                        <input type="email" name="email"/>
                    </td>
                </tr>
           END;
            ?>
        </table> <br>
        <button type="submit">Atualizar</button>
    </>
</body>

</html>