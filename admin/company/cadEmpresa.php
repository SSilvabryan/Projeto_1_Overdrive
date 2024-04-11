<?php
    require_once ("../../model\session\Login.php");

    // Obriga o Adm a estar Logado
    Login::requireLoginAdm();

    require_once ("../../model\Empresa.php");

    define('TITLE', 'Cadastrar Empresa');

    // Validação do POST
    if(isset($_POST['nomeEmp'], $_POST['nomeFantasia'], $_POST['cnpjEmp'], $_POST['telefone'], $_POST['endereco'], $_POST['responsavel'])) {

        // Busca Empresa pelo login
        $obEmpresa = Empresa::getEmpresaPorCNPJ($_POST['cnpjEmp']);
        if($obEmpresa instanceof Empresa) {
            echo ("<script>
                    window.alert('O CNPJ ".$_POST['cnpjEmp']." já é existente!')
                    window.location.href='cadEmpresa.php';
                </script>");
            exit;
        }

        $obEmpresa = new Empresa;
        $obEmpresa->nome = $_POST['nomeEmp'];
        $obEmpresa->nome_fantasia = $_POST['nomeFantasia'];
        $obEmpresa->cnpj = $_POST['cnpjEmp'];
        $obEmpresa->telefone = $_POST['telefone'];
        $obEmpresa->endereco = $_POST['endereco'];
        $obEmpresa->responsavel = $_POST['responsavel'];

        $obEmpresa->cadastrarEmpresa();

        header('location: ../dashboardEmp.php?status=successRegister');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITLE?></title>
    
    <link rel="stylesheet" href="../../estilos\cadastrar.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <link rel="shortcut icon" href="../../imagens\favicon\cadEmp.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../../imagens/add.svg" alt="Imagem Interativa para Cadastro de Empresa">
        </div>

        <div class="back-button">
            <a href="../dashboardEmp.php">
                <button><ion-icon name="arrow-back-outline"></ion-icon></button>
            </a>  
        </div>

        <div class="form">
            <form method="post" id="formulario">
                <div class="title">
                    <h1><?=TITLE?></h1>
                </div>

                <div class="input-group">
                    <div class="form-group">
                        <span class="icon"><ion-icon name="at-outline"></ion-icon></span>
                        <input type="text" name="nomeEmp" id="nEmpresa" required>
                        <label for="nEmpresa">Razão Social</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="logo-snapchat"></ion-icon></span>
                        <input type="text" name="nomeFantasia" id="nFantEmpresa" required>
                        <label for="nFantEmpresa">Nome Fantasia</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <input type="text" name="cnpjEmp" id="cnpj" required>
                        <label for="cnpj">CNPJ</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" name="telefone" id="telEmp" required>
                        <label for="telEmp">Telefone</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <input type="text" name="endereco" id="endEmp" required>
                        <label for="endEmp">Endereço</label>
                    </div>
                    
                    <div class="form-group">
                        <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                        <input type="text" name="responsavel" id="responsavelEmp" required>
                        <label for="responsavelEmp">Responsável</label>
                    </div>
                </div>

                <div>
                    <button type="submit" id="botaoSubmit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $("#cnpj").mask("99.999.999/9999-99");
        $("#telEmp").mask("(99) 9999-9999");
    </script>
</body>
</html>