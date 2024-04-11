<?php
    require_once ("../model\session\Login.php");

    // Obriga o Usuário a estar Logado
    Login::requireLogin();

    // Dados do Adm Logado
    $userLogado = Login::getUsuarioLogado();

    // Mensagens para as Ações
    $mensagem = '';
    if(isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'successRegister':
                $mensagem = '<div class="alert alert-success">Cadastro realizado com sucesso!</div>';
                break;
            
            case 'successEdit':
                $mensagem = '<div class="alert alert-success">Edição realizada com sucesso!</div>';
                break;

            case 'successDelete':
                $mensagem = '<div class="alert alert-success">Exclusão realizada com sucesso!</div>';
                break;

            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }

    require_once ("../model\Empresa.php");
    require_once ("../model\db\Pagination.php");
    require_once ("../buscaEmp.php");

    // Obtém as Empresas
    $empresas = Empresa::getEmpresas($whereCompany, 'nome', $obPaginationCompany->getLimit());

    // Disposição das Empresas na Tabela
    $resultadosCompany = '';
    foreach($empresas as $empresa) {
        $resultadosCompany .=  '<tr>
                                    <td data-title="ID" class="align-middle">'.$empresa->id_company.'</td>
                                    <td data-title="Razão Social" class="align-middle">'.$empresa->nome.'</td>
                                    <td data-title="Nome Fantasia" class="align-middle">'.$empresa->nome_fantasia.'</td>
                                    <td data-title="CNPJ" class="align-middle">'.$empresa->cnpj.'</td>
                                    <td data-title="Telefone" class="align-middle">'.$empresa->telefone.'</td>
                                    <td data-title="Endereço" class="align-middle">'.$empresa->endereco.'</td>
                                    <td data-title="Responsável" class="align-middle">'.$empresa->responsavel.'</td>
                                    <td data-title="Data de Cadastro" class="align-middle">'.date('d/m/Y à\s H:i:s', strtotime($empresa->data)).'</td>
                                </tr>';
    }

    // Disposição para quando não houver Empresas
    $resultadosCompany = strlen($resultadosCompany) ? $resultadosCompany : '<tr>
                                                            <td colspan="10" class="text-center">
                                                                Nenhuma Empresa Encontrada
                                                            </td>
                                                       </tr>';
    //

    //Gets 
    unset($_GET['status']);
    unset($_GET['pagina']);

    $getsEmp = http_build_query($_GET);

    // Paginação
    $paginacaoCompany = '';
    $paginasCompany = $obPaginationCompany->getPages();
    foreach($paginasCompany as $key=>$pagina) {
        $class = $pagina['atual'] ? 'btn-danger' : 'btn-light';
        $paginacaoCompany .= '<a href="?pagina='.$pagina['pagina'].'&'.$getsEmp.'"><button type="button" class="btn '.$class.' mr-1">'.$pagina['pagina'].'</button></a>';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresas</title>

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

    <?=$mensagem?>

    <div class="container">
        <section class="my-3">
            <div class="button">
                    <a href="dashboardUsuario.php">
                        <button><ion-icon name="person"></ion-icon></button>
                    </a>
            </div>
        </section>
    </div> 

    <div class="container">
        <section>
            <form method="get">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="buscaCompany" class="form-control" placeholder="Buscar Empresa: ID, Nome Fantasia, Responsável" value="<?=$buscaCompany?>">
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
                        <th class="align-middle">Razão Social</th>
                        <th class="align-middle">Nome Fantasia</th>
                        <th class="align-middle">CNPJ</th>
                        <th class="align-middle">Telefone</th>
                        <th class="align-middle">Endereço</th>
                        <th class="align-middle">Responsável</th>
                        <th class="align-middle">Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultadosCompany?>   
                </tbody>
            </table>
        </section>

        <section class="mb-5">
            <?=$paginacaoCompany?>
        </section>
    </div>
</body>
</html>