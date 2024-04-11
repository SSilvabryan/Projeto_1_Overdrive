<?php
    require_once ("../model\session\Login.php");

    // Obriga o Usuário a estar Logado
    Login::requireLogin();

    // Dados do Usuário Logado
    $userLogado = Login::getUsuarioLogado();

    require_once ("../model\Usuario.php");
    require_once ("../model\db\Pagination.php");
    require_once ("../busca.php");

    // Obtém os Usuários
    $usuarios = Usuario::getUsuarios($where, 'nome', $obPagination->getLimit());
    
    // Disposição dos Usuários na Tabela
    $resultados = '';
    foreach($usuarios as $usuario) {
        $resultados .= '<tr>
                            <td data-title="ID" class="align-middle">'.$usuario->id_usuario.'</td>
                            <td data-title="Nome" class="align-middle">'.$usuario->nome.'</td>
                            <td data-title="CPF" class="align-middle">'.$usuario->cpf.'</td>
                            <td data-title="CNH" class="align-middle">'.$usuario->cnh.'</td>
                            <td data-title="Telefone" class="align-middle">'.$usuario->telefone.'</td>
                            <td data-title="Endereço" class="align-middle">'.$usuario->endereco.'</td>
                            <td data-title="Carro" class="align-middle">'.$usuario->carro.'</td>
                            <td data-title="Empresa" class="align-middle">'.$usuario->empresa.'</td>
                            <td data-title="Data de Cadastro" class="align-middle">'.date('d/m/Y à\s H:i:s', strtotime($usuario->data)).'</td>
                        </tr>';
    }

    // Disposição para quando não houver Usuários
    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                            <td colspan="10" class="text-center">
                                                                Nenhum Usuário Encontrado
                                                            </td>
                                                       </tr>';


    //Gets 
    unset($_GET['status']);
    unset($_GET['pagina']);

    $gets = http_build_query($_GET);

    // Paginação
    $paginacao = '';
    $paginas = $obPagination->getPages();
    foreach($paginas as $key=>$pagina) {
        $class = $pagina['atual'] ? 'btn-danger' : 'btn-light';
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'"><button type="button" class="btn '.$class.' mr-1">'.$pagina['pagina'].'</button></a>';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuários</title>

    <link rel="stylesheet" href="../estilos\dashboard.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="shortcut icon" href="../imagens\favicon\dashboard.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand">Sistema CRUD</a>
            <?php
                print "Olá, " .$userLogado['nome'];
                print "<a href='../logout.php?cpf' class='btn btn-danger'>Sair</a>";
            ?>
        </div>
    </nav>

    <div class="container">
        <section class="my-3">
            <div class="button">
                    <a href="dashboardUsuarioEmp.php">
                        <button><ion-icon name="business"></ion-icon></button>
                    </a>
            </div>  
        </section>
    </div> 

    <div class="container">
        <section>
            <form method="get">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="buscaUser" class="form-control" placeholder="Buscar Usuário: Nome, CPF, Empresa" value="<?=$busca?>">
                    </div>
                </div>
            </form>
        </section>
    </div>
    
    <div class="container">
        <section>
            <table class="table table-hover mt-3">
                <thead class="thead">
                    <tr>
                        <th class="align-middle">ID</th>
                        <th class="align-middle">Nome</th>
                        <th class="align-middle">CPF</th>
                        <th class="align-middle">CNH</th>
                        <th class="align-middle">Telefone</th>
                        <th class="align-middle">Endereço</th>
                        <th class="align-middle">Carro</th>
                        <th class="align-middle">Empresa</th>
                        <th class="align-middle">Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </section>

        <section class="mb-3">
            <?=$paginacao?>
        </section>
    </div>
</body>
</html>