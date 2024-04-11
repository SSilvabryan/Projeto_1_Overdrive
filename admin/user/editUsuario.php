<?php
    require_once ("../../model\session\Login.php");
    // Obriga o Adm a estar Logado
    Login::requireLoginAdm();

    require_once ("../../model\Usuario.php");
    require_once ("../../model\Empresa.php");

    define('TITLE', 'Editar Usuário');

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
    if(isset($_POST['nomeUser'], $_POST['cpfUser'], $_POST['cnhUser'], $_POST['telUser'], $_POST['endUser'], $_POST['carUser'], $_POST['empUser'])) {

        // Busca Usuário pelo login
        $obUsuario = Usuario::getUsuarioPorCPF($_POST['cpfUser']);
        if($obUsuario instanceof Usuario && !($obUsuario->id_usuario == $_GET['id'])) {
            echo ("<script>
                    window.alert('O CPF ".$_POST['cpfUser']." já é existente!')
                    window.location.href='editUsuario.php';
                </script>");
            exit;
        }

        $obUsuario->nome = $_POST['nomeUser'];
        $obUsuario->cpf = $_POST['cpfUser'];
        $obUsuario->cnh = $_POST['cnhUser'];
        $obUsuario->telefone = $_POST['telUser'];
        $obUsuario->endereco = $_POST['endUser'];
        $obUsuario->carro = $_POST['carUser'];

        if(!is_numeric($_POST['empUser'])) {
            $obUsuario->id_company = $_GET['idEmp'];
        } else {
            $obUsuario->id_company = $_POST['empUser'];
        }
            
        $obUsuario->empresa = Empresa::getEmpresa($obUsuario->id_company)->nome_fantasia;

        $obUsuario->atualizarUsuario();

        header('location: ../dashboard.php?status=successEdit');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITLE?></title>

    <link rel="stylesheet" href="../../estilos\editar.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <link rel="shortcut icon" href="../../imagens\favicon\editar.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="back-button">
            <a href="../dashboard.php">
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
                        <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                        <input type="text" name="nomeUser" id="nUsuario" required value="<?=$obUsuario->nome?>">
                        <label for="nUsuario">Nome</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <input type="text" name="cpfUser" id="cpfUsuario" required value="<?=$obUsuario->cpf?>">
                        <label for="cpfUsuario">CPF</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <input type="text" name="cnhUser" id="cnhUsuario" required value="<?=$obUsuario->cnh?>">
                        <label for="cnhUsuario">CNH</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" name="telUser" id="telUsuario" required value="<?=$obUsuario->telefone?>">
                        <label for="telUsuario">Telefone</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <input type="text" name="endUser" id="endUsuario" required value="<?=$obUsuario->endereco?>">
                        <label for="endUsuario">Endereço</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="car-outline"></ion-icon></span>
                        <input type="text" name="carUser" id="carroUsuario" required value="<?=$obUsuario->carro?>">
                        <label for="carroUsuario">Carro</label>
                    </div>

                    <div id="empresa" class="form-group">
                        <label for="empUsuario">Empresa</label>
                        <span class="icon"><ion-icon name="business-outline"></ion-icon></span>
                        <select name="empUser" id="empUsuario" class="form-control" required>
                            <option value="<?=$obUsuario->empresa?>"><?=$obUsuario->empresa?></option>
                            <?php
                                $obEmpresas = new DataBase('empresa');
                                $registros = $obEmpresas->selectCompanies();
                                foreach($registros as $options) {
                                    if($options['nome_fantasia'] == $obUsuario->empresa) 
                                        continue;
                            ?>
                                    <option value="<?php echo $options['id_company']?>"><?php echo $options['nome_fantasia']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" id="botaoSubmit">Editar</button>
                </div>
            </form>
        </div>

        <div class="form-image">
            <img src="../../imagens/profile_details.svg" alt="Imagem Interativa para Cadastro de Usuário">
        </div>
    </div>

    <script>
        $("#cpfUsuario").mask("999.999.999-99");
        $("#telUsuario").mask("(99) 9999-9999");
    </script>
</body>
</html>