<?php
function limparDados(string $dado): string
{
    // Define as tags HTML que serão permitidas
    $tags = '<p><strong><i><ul><ol><li><h1><h2><h3>';
    
    // Remove todas as tags HTML, exceto as especificadas em $tags
    $retorno = htmlentities(strip_tags($dado, $tags));
    
    // Retorna o resultado limpo
    return $retorno;
}
?>
