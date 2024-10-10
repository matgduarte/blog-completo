<?php
function insert (string $entidade, array $dados): string
{
    $instrucao = "INSERT INTO {$entidade}";

    $campos = implode(',', array_keys($dados)); // Cria uma string com os nomes dos campos
    $valores = implode(',', array_values($dados)); // Cria uma string com os valores

    $instrucao .= " ({$campos})"; // Adiciona os campos à instrução
    $instrucao .= " VALUES ({$valores})"; // Adiciona os valores à instrução

    return $instrucao; // Retorna a instrução SQL
}

function update (string $entidade, array $dados, array $criterio =  [] ): string
{ 
    $instrucao = "UPDATE {$entidade}"; // Inicia a instrução UPDATE

    foreach ($dados as $campo => $dado) {
        $set[] = "{$campo} = {$dado}"; // Cria um array para definir os campos a serem atualizados
    }

    $instrucao .= ' SET ' . implode(', ', $set); // Adiciona a cláusula SET à instrução

    if (!empty($criterio)) { 
        $instrucao .= ' WHERE '; // Adiciona a cláusula WHERE se houver critérios

        foreach ($criterio as $expressao) {
            $instrucao .= ' ' . implode(' ', $expressao); // Adiciona cada critério
        }
    }

    return $instrucao; // Retorna a instrução SQL
}

function delete(string $entidade, array $criterio = []) : string
{
    $instrucao = "DELETE FROM {$entidade}"; // Inicia a instrução DELETE
    if(!empty($criterio)) {
        $instrucao .= ' WHERE '; // Adiciona a cláusula WHERE se houver critérios
        foreach ($criterio as $expressao) {
            $instrucao .= ' ' . implode(' ', $expressao); // Adiciona cada critério
        }
    }

    return $instrucao; // Retorna a instrução SQL
}

function select(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null) : string
{
    $instrucao = "SELECT " . implode(', ', $campos); // Inicia a instrução SELECT
    $instrucao .= " FROM {$entidade}"; // Adiciona a tabela da qual os dados serão selecionados

    if(!empty($criterio)) {
        $instrucao .= ' WHERE '; // Adiciona a cláusula WHERE se houver critérios
        foreach ($criterio as $expressao) {
            $instrucao .= ' ' . implode(' ', $expressao); // Adiciona cada critério
        }
    }

    if(!empty($ordem)) {
        $instrucao .= " ORDER BY {$ordem}"; // Adiciona a cláusula ORDER BY se houver
    }

    return $instrucao; // Retorna a instrução SQL
}
?>
