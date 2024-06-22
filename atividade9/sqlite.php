
<?php

function cadastrarProduto($db)
{
  system('clear');

  echo "Cadastro de novo produto." . PHP_EOL . PHP_EOL;
  $nome = readline('Nome do produto: ');
  $preco = readline('Preço do produto: ');
  $dataCadastro = date("Y-m-d H:i:s");

  echo PHP_EOL;

  $stmt = $db->prepare('INSERT INTO produtos (nome, preco, createdAt) VALUES (:nome, :preco, :createdAt)');
  $stmt->bindValue(':nome', $nome);
  $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
  $stmt->bindValue(':createdAt', $dataCadastro);
  $stmt->execute();

  echo 'Produto cadastrado com sucesso!' . PHP_EOL . PHP_EOL;

  $menu = 0;
  listarTodos($db, $menu);
}

function listarTodos($db, $menu)
{
  if ($menu == 1) {
    echo "Vizualizar todos: " . PHP_EOL . PHP_EOL;
  }

  $produtosSql = $db->query('SELECT * FROM produtos');

  while ($produtos = $produtosSql->fetchArray(SQLITE3_ASSOC)) {
    if ($produtos['updatedAt'] != NULL || $produtos['updatedAt'] != '') {
      echo "| {$produtos['id']} | {$produtos['nome']} \t| R\${$produtos['preco']} \t| Criado em: {$produtos['createdAt']} | Ultima atualização em: {$produtos['updatedAt']}" . PHP_EOL;
    } else {
      echo "| {$produtos['id']} | {$produtos['nome']} \t| R\${$produtos['preco']} \t| Criado em: {$produtos['createdAt']} |" . PHP_EOL;
    }
  }

  aguardarInput();
}

function listarItem($db)
{
  $id = readline('Informe o ID: ');

  imprimirItem($db, $id);

  aguardarInput();
}

function apagarItem($db)
{
  $id = readline('Informe o ID do item: ') . PHP_EOL;
  $apagarSql = $db->querySingle('DELETE FROM produtos WHERE id = ' . $id);

  $menu = 0;
  listarTodos($db, $menu);
}

function atualizarItem($db)
{
  echo "Operação atualizar escolhida, escolha um item pelo seu ID: " . PHP_EOL . PHP_EOL;

  $id = readline('ID: ');
  $produto = imprimirItem($db, $id);
  $queryUpdate = 'UPDATE produtos SET';

  if ($produto == false) {
    aguardarInput();
    return;
  };

  $nomesTabelasSql = $db->query('PRAGMA table_info(produtos)');
  $dadosTabela = array();
  $nomesTabela = array();

  while ($res = $nomesTabelasSql->fetchArray(SQLITE3_ASSOC)) {
    $dadosTabela[] = $res;
  };

  foreach ($dadosTabela as $key => $dados) {
    $verificaNome = str_ends_with($dados['name'], 'At');

    if ($dados['pk'] != '1') {
      if ($verificaNome != '1') {
        $nomesTabela[] = [$dados['name'], $dados['type']];
      }
    }
  }

  echo PHP_EOL;

  foreach ($nomesTabela as $nome) {
    $dados = readline(ucfirst($nome[0]) . ": ");
    if ($dados != '') {
      if ($nome[1] == 'INTEGER' || $nome[1] == 'REAL' || $nome[1] == 'NUMERIC') {
        $dadosNovos[$nome[0]] = (float)$dados;
      } else {
        $dadosNovos[$nome[0]] = $dados;
      }
    }
  }

  $ultimoDado = array_key_last($dadosNovos);

  foreach ($dadosNovos as $key => $dados) {
    if ($dados != '' || $dados != null) {
      $tipoDado = gettype($dados);
      if ($tipoDado != 'string') {
        $queryUpdate .= " {$key} = {$dados}";
      } else {
        $queryUpdate .= " {$key} = '{$dados}'";
      }

      if ($key == $ultimoDado) {
        $queryUpdate .= " WHERE id = {$id};";
      } else if ($key != $ultimoDado) {
        $queryUpdate .= ",";
      }
    }
  }

  $db->exec($queryUpdate);
  $dataUpdate = date("Y-m-d H:i:s");
  $db->exec("UPDATE produtos SET updatedAt = '{$dataUpdate}' WHERE id = {$id}");

  aguardarInput();
}

function limparTabela($db)
{
  echo "Operação limpar tabela escolhida, apagando todos os dados da tabela\nCaso queira cancelar, aperte Ctrl + C" . PHP_EOL . PHP_EOL;

  for ($i = 3; $i != 0; $i -= 1) {
    echo $i;
    sleep(1);
    for ($j = 3; $j != 0; $j -= 1) {
      echo ".";
      sleep(1);
    }
  }

  $db->exec("DELETE FROM produtos");

  echo "TABELA APAGADA" . PHP_EOL;

  sleep(1);

  aguardarInput();
}

function imprimirItem($db, $id)
{
  $produtoSql = $db->query('SELECT * FROM produtos WHERE id = ' . $id);
  $produto = $produtoSql->fetchArray(SQLITE3_ASSOC);

  if ($produto == false) {
    echo PHP_EOL . "ID informado não encontrado." . PHP_EOL;
  } else if ($produto['updatedAt'] != NULL || $produto['updatedAt'] != '') {
    echo "| {$produto['id']} | {$produto['nome']} \t| R\${$produto['preco']} \t| Criado em: {$produto['createdAt']} | Ultima atualização em: {$produto['updatedAt']}" . PHP_EOL;
  } else {
    echo "| {$produto['id']} | {$produto['nome']} \t| R\${$produto['preco']} \t| Criado em: {$produto['createdAt']} |" . PHP_EOL;
  }

  return $produto;
}

function aguardarInput()
{
  echo PHP_EOL;
  readline('Pressione uma ENTER/RETURN para continuar...');
  system('clear');
}

$operacoes = [
  0 => ['operacao' => 'Cadastrar produto'],
  1 => ['operacao' => 'Visualizar todos os produtos cadastrados'],
  2 => ['operacao' => 'Visualizar cadastro produto'],
  3 => ['operacao' => 'Atualizar cadastro produto'],
  4 => ['operacao' => 'Apagar cadastro do produto'],
  5 => ['operacao' => 'Limpar tabela'],
];

$menu = 1;

while (true) {
  system('clear');

  echo "Seja bem vindo! Por favor, escolha uma operação." . PHP_EOL . PHP_EOL;

  foreach ($operacoes as $key => $operacao) {
    echo "[{$key}] - {$operacao['operacao']}" . PHP_EOL;
  }

  echo PHP_EOL . "[e] - Sair" . PHP_EOL;

  echo PHP_EOL;

  $db = new SQLite3('database.sqlite');

  // $produtosSql = $db->query('SELECT * FROM produtos');

  $operacao = readline('Operação: ');
  echo PHP_EOL;

  switch ($operacao) {
    case 0:
      cadastrarProduto($db);
      break;
    case 1:
      listarTodos($db, $menu);
      break;
    case 2:
      listarItem($db);
      break;
    case 3:
      atualizarItem($db);
      break;
    case 4:
      apagarItem($db);
      break;
    case 5:
      limparTabela($db);
      break;
    case 'e';
      exit;
  }
}
