<?php
    // Busca Usuários
    $busca = filter_input(INPUT_GET, 'buscaUser', FILTER_SANITIZE_STRING);
    
    // Condições SQL
    $condicoes = [
        strlen($busca) ? 'nome LIKE "%'.str_replace(' ', '%', $busca).'%"' : null,
        strlen($busca) ? 'cpf LIKE "%'.str_replace(' ', '%', $busca).'%"' : null,
        strlen($busca) ? 'empresa LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
    ];

    // Remove posições vazias
    $condicoes = array_filter($condicoes);

    // Cláusula WHERE
    $where = implode(' OR ', $condicoes);

    // Quantidade Total de Usuários
    $quantidadeUsuario = Usuario::getQtdUsuarios($where);

    // Paginação
    $obPagination = new Pagination($quantidadeUsuario, $_GET['pagina'] ?? 1, 4);
?>
