
<?php

function cadastrarProduto($db)
{
  system('clear');

  echo "Cadastro de novo produto." . PHP_EOL . PHP_EOL;
  $nome = readline('Nome do produto: ');
  $preco = readline('Preço do produto: ');
  $dataCadastro = date("Y-m-d H:i:s");

  echo PHP_EOL;

  $stmt = $db->prepare('INSERT INTO produtos (nome, preco, data_criacao) VALUES (:nome, :preco, :data_criacao)');
  $stmt->bindValue(':nome', $nome);
  $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
  $stmt->bindValue(':data_criacao', $dataCadastro);
  $stmt->execute();

  echo 'Produto cadastrado com sucesso!' . PHP_EOL;

  listarTodos($db);
}

function listarTodos($db)
{
  // system('clear');

  echo "Vizualizar todos: " . PHP_EOL . PHP_EOL;
  $produtosSql = $db->query('SELECT * FROM produtos');
  while ($produtos = $produtosSql->fetchArray(SQLITE3_ASSOC)) {
    echo "| {$produtos['id']} | {$produtos['nome']} \t| R\${$produtos['preco']} \t| Criado em: {$produtos['data_criacao']} |" . PHP_EOL;
  }

  aguardarInput();
}

function listarItem($db)
{
  system('clear');

  $id = readline('Informe o ID: ');

  echo PHP_EOL;
  imprimirItem($db, $id);

  aguardarInput();
}

function apagarItem($db)
{
  $id = readline('Informe o ID do item: ') . PHP_EOL;
  $apagarSql = $db->querySingle('DELETE FROM produtos WHERE id = ' . $id);

  listarTodos($db);
}

function atualizarItem($db)
{
  echo "Operação atualizar escolhida, escolha um item pelo seu ID: " . PHP_EOL . PHP_EOL;

  $id = readline('ID: ');
  $produto = imprimirItem($db, $id);

  $nomesTabelasSql = $db->query('PRAGMA table_info(produtos)');
  $dadosTabela = array();
  $nomesTabela = array();

  while ($res = $nomesTabelasSql->fetchArray(SQLITE3_ASSOC)) {
    array_push($dadosTabela, $res);
  };

  foreach ($dadosTabela as $key => $dados) {
    $verificaNome = str_ends_with($dados['name'], 'At');

    if ($dados['pk'] != '1') {
      if ($verificaNome != '1') {
        array_push($nomesTabela, $dados['name']);
      }
    }
  }

  foreach ($nomesTabela as $nome) {
    $nome = readline(ucfirst($nome) . ": ") . PHP_EOL;
  }

  var_dump($nomesTabela);

  if ($produto == false) {
    aguardarInput();
    return;
  };

  $atualizarSql = $db->querySingle('UPDATE produtos SET nome = "",preco = {$preco} WHERE {$id}');

  aguardarInput();
}

function imprimirItem($db, $id)
{
  $produtoSql = $db->query('SELECT * FROM produtos WHERE id = ' . $id);
  $produto = $produtoSql->fetchArray(SQLITE3_ASSOC);

  if ($produto == false) {
    echo "ID informado não encontrado." . PHP_EOL;
  } else {
    echo "| {$produto['id']} | {$produto['nome']} \t| R\${$produto['preco']} \t| Criado em: {$produto['data_criacao']} |" . PHP_EOL;
  }

  // aguardarInput();

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
];

while (true) {
  system('clear');

  echo "Seja bem vindo! Por favor, escolha uma operação." . PHP_EOL . PHP_EOL;

  foreach ($operacoes as $key => $operacao) {
    echo "[{$key}] - {$operacao['operacao']}" . PHP_EOL;
  }

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
      system('clear');
      listarTodos($db);
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
  }
}
