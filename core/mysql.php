<?php

// Função para inserir um registro no banco de dados
function insere(string $entidade, array $dados) : bool
{
    $retorno = false; // Inicializa a variável de retorno como falso

    // Prepara os dados para a inserção
    foreach ($dados as $campo => $dado) {
        $coringa[$campo] = '?'; // Define o coringa para o campo
        $tipo[] = gettype($dado)[0]; // Obtém o tipo de dado
        $$campo = $dado; // Cria uma variável dinâmica para o campo
    }

    $instrucao = insert($entidade, $coringa); // Chama a função insert

    $conexao = conecta(); // Conecta ao banco de dados

    // Prepara a instrução SQL
    $stmt = mysqli_prepare($conexao, $instrucao);

    // Vincula os parâmetros da instrução preparada
    eval('mysqli_stmt_bind_param($stmt, \'' . implode('', $tipo) . '\',$' . implode(', $', array_keys($dados)) . ');');

    // Executa a instrução
    mysqli_stmt_execute($stmt);

    // Verifica se houve linhas afetadas
    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

    // Armazena erros, se houver
    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt); // Fecha a instrução
    desconecta($conexao); // Desconecta do banco de dados

    return $retorno; // Retorna o resultado
}

// Função para atualizar um registro no banco de dados
function atualiza(string $entidade, array $dados, array $criterio = []) : bool
{
    $retorno = false;

    // Prepara os dados para a atualização
    foreach ($dados as $campo => $dado) {
        $coringa_dados[$campo] = '?';
        $tipo[] = gettype($dado)[0];
        $$campo = $dado;
    }

    // Prepara os critérios para a atualização
    foreach ($criterio as $expressao) {
        $dado = $expressao[count($expressao) -1];
        $tipo[] = gettype($dado)[0];
        $expressao[count($expressao) -1] = '?';
        $coringa_criterio[] = $expressao;

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];
        
        if (isset($nome_campo)) {
            $$nome_campo = $nome_campo . ' ' . rand();
        }

        $campos_criterio[] = $nome_campo;
        $$nome_campo = $dado; // Cria uma variável dinâmica para o campo de critério
    }

    $instrucao = update($entidade, $coringa_dados, $coringa_criterio); // Chama a função update

    $conexao = conecta();

    $stmt = mysqli_prepare($conexao, $instrucao);

    // Vincula os parâmetros
    if (isset($tipo)) {
        $comando = 'mysqli_stmt_bind_param($stmt,';
        $comando .= '\'' . implode('', $tipo) . '\',';
        $comando .= '$' . implode(', $', array_keys($dados)) . ',';
        $comando .= '$' . implode(', $', $campos_criterio) . ');';
    
        eval($comando);
    }

    mysqli_stmt_execute($stmt);
    
    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt);
    desconecta($conexao);

    return $retorno;
}

// Função para deletar um registro do banco de dados
function deleta(string $entidade, array $criterio = []) : bool
{
    $retorno = false;

    foreach ($criterio as $expressao) {
        $dado = $expressao[count($expressao) -1];
        $tipo[] = gettype($dado)[0];
        $expressao[count($expressao) -1] = '?';
        $coringa_criterio[] = $expressao;

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

        if (isset($nome_campo)) {
            $$nome_campo = $nome_campo . ' ' . rand();
        }

        $campos_criterio[] = $nome_campo;
        $$nome_campo = $dado; // Cria uma variável dinâmica para o campo de critério
    }

    $instrucao = delete($entidade, $coringa_criterio); // Chama a função delete
    $conexao = conecta();

    $stmt = mysqli_prepare($conexao, $instrucao);

    // Vincula os parâmetros
    if (isset($tipo)) {
        $comando = 'mysqli_stmt_bind_param($stmt,';
        $comando .= '\'' . implode('', $tipo) . '\',';
        $comando .= '$' . implode(', $', $campos_criterio) . ');';
    
        eval($comando);
    }

    mysqli_stmt_execute($stmt);
    
    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt);
    desconecta($conexao);

    return $retorno;
}

// Função para buscar registros no banco de dados
function buscar(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) : array
{
    $retorno = false;
    $coringa_criterio = [];

    foreach ($criterio as $expressao) {
        $dado = $expressao[count($expressao) -1];
        $tipo[] = gettype($dado)[0];
        $expressao[count($expressao) -1] = '?';
        $coringa_criterio[] = $expressao;

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

        if (isset($nome_campo)) {
            $$nome_campo = $nome_campo . ' ' . rand();
        }

        $campos_criterio[] = $nome_campo;
        $$nome_campo = $dado; // Cria uma variável dinâmica para o campo de critério
    }

    $instrucao = select($entidade, $campos, $coringa_criterio, $ordem); // Chama a função select

    $conexao = conecta();

    $stmt = mysqli_prepare($conexao, $instrucao);

    // Vincula os parâmetros
    if (isset($tipo)) {
        $comando = 'mysqli_stmt_bind_param($stmt,';
        $comando .= '\'' . implode('', $tipo) . '\',';
        $comando .= '$' . implode(', $', $campos_criterio) . ');';
    
        eval($comando);
    }

    mysqli_stmt_execute($stmt);

    // Obtém os resultados da execução da consulta
    if ($result = mysqli_stmt_get_result($stmt)) {
        $retorno = mysqli_fetch_all($result, MYSQLI_ASSOC); // Retorna todos os registros como um array associativo

        mysqli_free_result($result); // Libera a memória do resultado
    }

    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt);
    desconecta($conexao);

    return $retorno; // Retorna os registros encontrados
}

?>
