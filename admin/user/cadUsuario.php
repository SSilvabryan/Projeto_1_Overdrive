<?php
    require_once ("../../model\session\Login.php");

    // Obriga o Adm a estar Logado
    Login::requireLoginAdm();

    require_once ("../../model\Usuario.php");
    require_once ("../../model\Empresa.php");
    define('TITLE', 'Cadastrar Usuário');

    // Validação do POST
    if(isset($_POST['nomeUser'], $_POST['cpfUser'], $_POST['cnhUser'], $_POST['telUser'], $_POST['endUser'], $_POST['carUser'], $_POST['empUser'], $_POST['senhaUser'])) {

        // Busca Usuário pelo login
        $obUsuario = Usuario::getUsuarioPorCPF($_POST['cpfUser']);
        if($obUsuario instanceof Usuario) {
            echo ("<script>
                    window.alert('O CPF ".$_POST['cpfUser']." já é existente!')
                    window.location.href='cadUsuario.php';
                </script>");
            exit;
        }

        $obUsuario = new Usuario;
        $obUsuario->nome = $_POST['nomeUser'];
        $obUsuario->cpf = $_POST['cpfUser'];
        $obUsuario->cnh = $_POST['cnhUser'];
        $obUsuario->telefone = $_POST['telUser'];
        $obUsuario->endereco = $_POST['endUser'];
        $obUsuario->carro = $_POST['carUser'];
        $obUsuario->senha = md5($_POST['senhaUser']);
        $obUsuario->id_company = $_POST['empUser'];

        $obUsuario->empresa = Empresa::getEmpresa($obUsuario->id_company)->nome_fantasia;

        $obUsuario->cadastrarUsuario();
        
        header('location: ../dashboard.php?status=successRegister');
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

    <link rel="shortcut icon" href="../../imagens\favicon\cadUser.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="form-image">
            <img src="../../imagens/add_user.svg" alt="Imagem Interativa para Cadastro de Usuário">
        </div>

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
                        <input type="text" name="nomeUser" id="nUsuario" required>
                        <label for="nUsuario">Nome Completo</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <input type="text" name="cpfUser" id="cpfUsuario" required>
                        <label for="cpfUsuario">CPF</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                        <input type="text" name="cnhUser" id="cnhUsuario" required>
                        <label for="cnhUsuario">CNH</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" name="telUser" id="telUsuario" required>
                        <label for="telUsuario">Telefone</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <input type="text" name="endUser" id="endUsuario" required>
                        <label for="endUsuario">Endereço</label>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="car-outline"></ion-icon></span>
                        <input type="text" name="carUser" id="carroUsuario" required>
                        <label for="carroUsuario">Carro</label>
                    </div>

                    <div id="empresa" class="form-group">
                        <label for="empUsuario">Empresa</label>
                        <span class="icon"><ion-icon name="business-outline"></ion-icon></span>
                        <select name="empUser" id="empUsuario" class="form-control" required>
                            <option value="11">Inativo</option>
                            <?php
                                $obDataBase = new DataBase('empresa');
                                $registros = $obDataBase->selectCompanies();
                                foreach($registros as $options) {
                                    if($options['nome_fantasia'] == 'Inativo') 
                                        continue;
                            ?>
                                    <option value="<?php echo $options['id_company']?>"><?php echo $options['nome_fantasia']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" name="senhaUser" id="senhaUsuario" required>
                        <label for="senhaUsuario">Senha</label>
                    </div>
                </div>

                <div>
                    <button type="submit" id="botaoSubmit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $("#cpfUsuario").mask("999.999.999-99");
        $("#telUsuario").mask("(99) 9999-9999");
    </script>
</body>
</html>