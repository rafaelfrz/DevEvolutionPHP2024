<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Página teste</title>

	<style>
		table,
		th,
		td {
			border: 1px solid black;
		}
	</style>

</head>

<body>
	<!-- CADASTRAR USUÁRIO -->
	<h1>Formulário de cadastro</h1>

	<form method="POST" action="cadastrar_usuario.php">
		<table>
			<tr>
				<td>
					<label for="email">Email: </label>
				</td>
				<td>
					<input type="email" name="email" required /> <br>
				</td>
			</tr>
			<tr>
				<td>
					<label for="name">Nome: </label>
				</td>
				<td>
					<input type="text" name="name" required /> <br>
				</td>
			</tr>
			<tr>
				<td>
					<label for="password">Senha: </label>
				</td>
				<td>
					<input type="password" name="password" required /> <br>
				</td>
			</tr>
		</table> <br>
		<button type="submit">Enviar</button>
	</form>

	<!-- LISTAR USUÁRIOS -->
	<h1>Usuários Cadastrados</h1>
	<?php
	require 'config.php';

	$usuarios = array();
	$usuariosQuery = $db->query('SELECT * FROM usuarios');
	while ($res = $usuariosQuery->fetchArray(SQLITE3_ASSOC)) {
		$usuarios[] = $res;
	} 
	
	{
		echo <<<END
			<table>
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Nome</th>
				</tr>
		END;
		foreach ($usuarios as $usuario) {
			echo <<<END
				<tr>
					<td>{$usuario['id']}</td>
					<td>{$usuario['email']}</td>
					<td>{$usuario['name']}</td>
					<td>
						<a href="apagar_usuario.php?id={$usuario['id']}">
							<button type="submit">
								Apagar
							</button>
						</a>
					</td>
				</tr>
			END;
		}
		
		echo '</table>';
	}
	?>

</body>

</html>