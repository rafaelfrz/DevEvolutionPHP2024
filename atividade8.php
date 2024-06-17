<?php

function cadastrarUsuario(array $dados) {
    system('clear');
    echo 'Operação de cadastro escolhida, informe um email e nome de usuário.' . PHP_EOL . PHP_EOL;

    $email = readline('Email: ');
    $usuario = readline('Nome: ');

    echo PHP_EOL;

    if(array_key_exists($email,$dados) == false) {
        $dados[$email] = [
            'email' => $email,
            'nome' => $usuario,
            'createdAt' => date("Y-m-d H:i:s"),
            'updatedAt' => null
        ];
        echo 'Usuário cadastrado com sucesso' . PHP_EOL;
    } else {
        echo 'Usuário com esse email já cadastrado.' . PHP_EOL . PHP_EOL;
    }

    aguardarInput();

    return $dados;
}

function operacoesLista(array $dados) {
    system('clear');

    $operacoesLista = [
        0 => ['descricao' => 'Listar todos'],
        1 => ['descricao' => 'Listar individual'],
    ];

    echo 'Operação listar escolhida: ' . PHP_EOL . PHP_EOL;

    foreach($operacoesLista as $key => $operacao) { // Impressão das operações de listagem dos usuários
        echo '[' . ($key + 1) . '] - ' . $operacao['descricao'] . PHP_EOL;
    }

    echo PHP_EOL;
    $operacaoListaRead = readline('Operação: ');
    echo PHP_EOL;

    if(is_numeric($operacaoListaRead) == true) {
        $operacaoListaRead -= 1;
    } else if (is_string($operacaoListaRead == true)) {
        $operacaoListaRead = strtolower($operacaoListaRead);
    };

    switch($operacaoListaRead) {
        case 0:
            listarUsuarios($dados);
            break;
        case 1:
            listarUsuario($dados);
            break;
    }
}

function listarUsuarios(array $dados) {
    foreach($dados as $key => $dado) {
        if ($dado['updatedAt'] == null) {
            echo '[Usuário: ' . $dado['nome'] . ']' . PHP_EOL . '[Email: ' . $key . ']' . PHP_EOL . '[Criado em: ' . $dado['createdAt'] . ']' . PHP_EOL . PHP_EOL;
        } else {
            echo '[Usuário: ' . $dado['nome'] . ']' . PHP_EOL . '[Email: ' . $key . ']' . PHP_EOL . '[Criado em: ' . $dado['createdAt'] . ']' . PHP_EOL . '[Última atualização em: ' . $dado['updatedAt'] . ']' . PHP_EOL . PHP_EOL;
        }
    }

    aguardarInput();
}

function listarUsuario(array $dados) {
    system('clear');
    $email = readline('Email: ');
    echo PHP_EOL;

    if(array_key_exists($email,$dados) == false) {
        echo PHP_EOL . 'Usuário com email informado não encontrado.' . PHP_EOL;
        aguardarInput();
    } else if (array_key_exists($email,$dados) == true) {
        // echo '[Usuário: ' . $dados[$email]['nome'] . ']' . PHP_EOL . '[Email: ' . $email . ']' . PHP_EOL . '[Criado em: ' . $dados[$email]['createdAt'] . ']' . PHP_EOL . PHP_EOL;
        if ($dados[$email]['updatedAt'] == null) {
            echo '[Usuário: ' . $dados[$email]['nome'] . ']' . PHP_EOL . '[Email: ' . $email . ']' . PHP_EOL . '[Criado em: ' . $dados[$email]['createdAt'] . ']' . PHP_EOL . PHP_EOL;
        } else {
            echo '[Usuário: ' . $dados[$email]['nome'] . ']' . PHP_EOL . '[Email: ' . $email . ']' . PHP_EOL . '[Criado em: ' . $dados[$email]['createdAt'] . ']' . PHP_EOL . '[Última atualização em: ' . $dados[$email]['updatedAt'] . ']' . PHP_EOL . PHP_EOL;
        }
        aguardarInput();
    }
}

function apagarUsuario(array $dados) {
    system('clear');
    echo 'Operação apagar escolhida, informe o email do usuário que deseja apagar: ' . PHP_EOL . PHP_EOL;

    $email = readline('Email: ');

    if(array_key_exists($email,$dados) == false) {
        echo PHP_EOL . 'Usuário com email informado não encontrado.' . PHP_EOL;
        aguardarInput();
    } else if (array_key_exists($email,$dados) == true) {
        unset($dados[$email]);
        echo 'Usuário apagado com sucesso.' . PHP_EOL;
        aguardarInput();
    }

    return $dados;
}

function atualizarUsuarios(array $dados) {
    system('clear');
    echo 'Operação apagar escolhida, informe o email do usuário que deseja atualizar: ' . PHP_EOL . PHP_EOL;

    $email = readline('Email: ');

    if(array_key_exists($email,$dados) == false) {
        echo PHP_EOL . 'Usuário com email informado não encontrado.';
    } else if (array_key_exists($email,$dados) == true) {
        echo 'Nome: ' . $dados[$email]['nome'] . PHP_EOL;
        $dados[$email]['nome'] = readline('Nome novo: ');
        $dados[$email]['updatedAt'] = date("Y-m-d H:i:s");
        echo 'Usuário atualizado com sucesso.';
    }
    aguardarInput();
    return $dados;
}

function popularArrayTestes(array $dados) { // Função para popular o array automaticamente para testar outras operações
    $dados = [
        'rafaelferraz06@gmail.com' => ['nome' => 'Rafael Ferraz','createdAt' => date("Y-m-d H:i:s"),'updatedAt' => null],
        'marcolindev@gmail.com' => ['nome' => 'Marcos Marcolin','createdAt' => date("Y-m-d H:i:s"),'updatedAt' => null],
        'johndoe@gmail.com' => ['nome' => 'John Doe','createdAt' => date("Y-m-d H:i:s"),'updatedAt' => null]
    ];
    return $dados;
}

function aguardarInput() {
    echo PHP_EOL;
    readline('Pressione uma ENTER/RETURN para continuar...');
    system('clear');
}

$dados = [];

$operacoes = [
    0 => ['descricao' => 'Cadastrar'],
    1 => ['descricao' => 'Listar'],
    2 => ['descricao' => 'Atualizar'],
    3 => ['descricao' => 'Apagar'],
];

system('clear');
$primeiroLoop = 1;
$erroEscolhaOperacao = 0;

while(true) {
    if ($primeiroLoop == 1) { // Tratamento para não repetir "Seja bem vindo!" diversas vezes
        echo 'Seja bem vindo! Por favor, escolha uma operação: ' . PHP_EOL . PHP_EOL;
    } else if ($primeiroLoop == 0 && $erroEscolhaOperacao) { // Mensagem caso o usuário informe um número de operação que nao existe;
        echo 'Por favor, escolha uma operação válida: ' . PHP_EOL . PHP_EOL;
    } else if ($primeiroLoop == 0 && $erroEscolhaOperacao == 0) {
        echo 'Por favor, escolha uma operação: ' . PHP_EOL . PHP_EOL;
    }
    
    foreach($operacoes as $key => $operacao) { // Impressão das operações possíveis para o usuário
        echo '[' . ($key + 1) . '] - ' . $operacao['descricao'] . PHP_EOL;
    }

    echo  PHP_EOL . '[e] - Sair' . PHP_EOL . PHP_EOL;

    $operacaoRead = readline('Operação: '); // Leitura de operação com (-1) para condizer com as chaves de operação do array $operacoes
    $operacaoReadLength = 0;

    if(is_numeric($operacaoRead) == true) {
        $operacaoRead -= 1;
    } else if (is_string($operacaoRead)) {
        $operacaoRead = strtolower($operacaoRead);
        $operacaoReadLength = strlen($operacaoRead);
    };

    echo PHP_EOL;

    if(array_key_exists($operacaoRead,$operacoes) && is_numeric($operacaoRead)) { // Verificando se a chave da operação existe
        switch($operacaoRead) {
            case 0:
                $dados = cadastrarUsuario($dados);
                break;
            case 1:
                operacoesLista($dados);
                break;
            case 2:
                $dados = atualizarUsuarios($dados);
                break;
            case 3:
                $dados = apagarUsuario($dados);
                break;
        }
    } else if ($operacaoRead = 'teste' && $operacaoReadLength > 1) {
        $dados = popularArrayTestes($dados);
        system('clear');
    } else if ($operacaoRead = 'e') {
        exit;
    } else {
        echo 'Operação desconhecida. ' . PHP_EOL;
        sleep(2);
        system('clear');
    }
    $primeiroLoop = 0;
}

?>