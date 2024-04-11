<?php
    require_once ("../../model\session\Login.php");

    // Obriga o Adm a estar Logado
    Login::requireLoginAdm();

    require_once ("../../model\Usuario.php");

    define('TITLE', 'Excluir Usuário');

    // Validação do ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
        header('location: ../dashboard.php?status=error');
        exit;
    }

    // Consulta o Usuário
    $obUsuario = Usuario::getUsuario($_GET['id']);

    // Validação do Usuário
    if(!$obUsuario instanceof Usuario) {
        header('location: ../dashboard.php?status=error');
        exit;
    }

    // Validação do POST
    if(isset($_POST['excluir'])) {
        $obUsuario->excluirUsuario();

        header('location: ../dashboard.php?status=successDelete');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITLE?></title>

    <link rel="stylesheet" href="../../estilos\delete.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <link rel="shortcut icon" href="../../imagens\favicon\excluir.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../../imagens/throw_away.svg" alt="Imagem Interativa para Cadastro de Usuário">
        </div>

        <div class="back-button">
            <a href="../dashboard.php">
                <button><ion-icon name="arrow-back-outline"></ion-icon></button>
            </a>
        </div>
        
        <div class="form">
            <form method="post" id="formulario">
                <div class="form-header">
                    <div class="title">
                        <h1><?=TITLE?></h1>
                    </div>

                    <div class="infoDelete">
                        <p id="infoDelete">Você realmente deseja excluir o Usuário <strong><?=$obUsuario->nome?></strong>?</p>
                    </div>
                </div>

                <div class="p-group">
                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <p>CPF - <?=$obUsuario->cpf?></p>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <p>CNH - <?=$obUsuario->cnh?></p>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <p>Telefone - <?=$obUsuario->telefone?></p>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <p>Endereço - <?=$obUsuario->endereco?></p>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="car-outline"></ion-icon></span>
                        <p>Carro - <?=$obUsuario->carro?></p>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="business-outline"></ion-icon></span>
                        <p>Empresa - <?=$obUsuario->empresa?></p>
                    </div>
                </div>

                <div>
                    <button type="submit" name="excluir" class="btn btn-danger" id="botaoSubmit">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>