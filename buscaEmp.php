<?php
    // Busca Empresas
    $buscaCompany = filter_input(INPUT_GET, 'buscaCompany', FILTER_SANITIZE_STRING);

    // Condições SQL
    $condicoesCompany = [
        strlen($buscaCompany) ? 'id_company LIKE "%' .str_replace(' ', '%', $buscaCompany). '%"' : null,
        strlen($buscaCompany) ? 'nome_fantasia LIKE "%' .str_replace(' ', '%', $buscaCompany). '%"' : null,
        strlen($buscaCompany) ? 'responsavel LIKE "%' .str_replace(' ', '%', $buscaCompany). '%"' : null
    ];

    // Remove posições vazias
    $condicoesCompany = array_filter($condicoesCompany);

    // Cláusula WHERE
    $whereCompany = implode(' OR ', $condicoesCompany);

    // Quantidade Total de Empresas
    $quantidadeCompany = Empresa::getQtdEmpresas($whereCompany);

    // Paginação
    $obPaginationCompany = new Pagination($quantidadeCompany, $_GET['pagina'] ?? 1, 4);
?>
