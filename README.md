# DevEvolutionPHP2024

##### Table of Contents
[Headers](#headers)

## Atividade 9

Menu de Operações CRUD com SQLite em PHP

### Objetivo

Criar um menu interativo no terminal para realizar operações CRUD (Create, Read, Update, Delete) em um banco de dados SQLite.

### Requisitos

Criar uma tabela 'produtos', com a seguinte estrutura.

- id: INTEGER, PRIMARY KEY, AUTO INCREMENT
- nome: TEXT, NOT NULL
- preco: REAL, NOT NULL
- data_criacao: TEXT, NOT NULL (armazenar datahora Y-m-d H:i:s)
- data_atualizacao: TEXT, NULL (armazenar datahora Y-m-d H:i:s)

### Funções CRUD:

- [X] Cadastrar Produto: Inserir um novo produto no banco de dados.
- [X] Listar Todos os Produtos: Listar todos os produtos cadastrados.
- [X] Listar Produto por ID: Buscar um produto pelo ID e exibir seus detalhes.
- [X] Atualizar Produto: Atualizar os dados de um produto pelo ID. (possibilidade de atualizar somente nome e preço, além da data_atualizacao)
- [X] Excluir Produto: Excluir um produto pelo ID.
- [X] Limpar Tabela: Excluir todos os produtos da tabela. (DELETE FROM nome_da_tabela)

### Menu Interativo:

Oferecer as opções:

- [X] Cadastrar um produto
- [X] Listar todos os produtos
- [X] Listar um produto pelo ID
- [X] Atualizar um produto pelo ID
- [X] Excluir um produto pelo ID
- [X] Limpar tabela de produtos
- [X] Sair

### Instruções

Garantir que o menu seja intuitivo.
Tratar possíveis erros e validar entradas.
Para desenvolver é necessário instalar o SQLite3 + a extensão para o PHP.

### Referências

https://sqlite.org/
https://www.php.net/manual/en/sqlite3.query.php
https://www.php.net/manual/en/sqlite3.prepare.php

### Avaliação

Entrega somente até o início da próxima aula (22/06 às 08h).

Podem zipar os arquivos e enviar para marcolindev@gmail.com ou enviar para seu GitHub e anexar o link no email.

O Título do Email deverá ser: Atividade DevEvolution PHP + SQLite - Seu Nome

## Atividade Formulários

#### Cadastro

- [X] Criar um banco SQLite e uma tabela de usuários
- [X] Receber os dados do usuário
- [X] Armazenar no banco de dados
- [X] Criptografar a senha
- [X] Retornar para o index.php -> header('Location: index.php');

#### Listar

- [X] Conectar com o banco
- [X] Consultar dados da tabela de usuários
- [X] Iterar os dados com uma TABLE html

#### Deletar

- [X] Criar uma coluna na tabela HTML para Deletar um usuário
- [X] Usar a tag anchor para enviar o id para um arquivo que vai deletar usuário
- [X] Redirecionar o index após deletar
