<?php
    require_once ("model/session/Login.php");

    // Obriga o Adm a Não estar Logado
    Login::requireLogoutAdm();

    // Obriga o Usuário a Não estar Logado
    Login::requireLogout();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="estilos/styleLogin.css">

    <script src="js/login.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <link rel="shortcut icon" href="imagens\favicon\favicon.ico" type="image/x-icon">

    <title>Sistema de Login</title>
    
</head>
<body>
    </script>
    <header>
        <img src="imagens/logo.png" id="logo-header" alt="Logo Overdrive">
        <nav class="navigation">
            <button id="btnLogin-popup" onclick="aparecer()">Login</button>
        </nav> 
    </header>

    <form method="post">
        <div class="main-login">
            <div class="login">
                <div class="card">
                    <span class="icon-close" onclick="aparecer()">
                        <ion-icon name="close-outline"></ion-icon>
                    </span>

                    <div class="card-login">
                        <h1>Login</h1>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <input type="text" name="usuario" id="usuario">
                            <label for="usuario">Usuário</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <input type="password" name="senha" id="senha">
                            <label for="senha">Senha</label>
                        </div>
                        <button class="btn-login" type="submit" name="acao" value="entrarAdmin">Entrar</button>
                        <div class="login-default">
                            <a class="user-default" onclick="trocar()">Logar como Usuário</a>
                        </div>
                    </div>
                    
                    <div class="card-loginUsuario">
                        <h1>Login</h1>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <input type="text" name="login" id="cpf" oninput="mascara(this)">
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <input type="password" name="senhaUser" id="senhaUser">
                            <label for="senha">Senha</label>
                        </div>
                        <button class="btn-login" type="submit" name="acao" value="entrar">Entrar</button>
                        <div class="login-default">
                            <a class="user" onclick="trocar()">Logar como ADMIN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

<?php
    require_once ("model/Usuario.php");
    require_once ("model/Admin.php");
    require_once ("model/session/Login.php");

    if(isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'entrarAdmin':
                // Busca Adm pelo login
                $obAdmin = Admin::getAdmPorLogin($_POST['usuario']);

                // Valida a instância e a senha
                if(!$obAdmin instanceof Admin || ($_POST['senha'] !== $obAdmin->senha)) {
                    echo "<script>alert('Login e/ou senha inválido(s)');</script>";
                    break;
                }
                
                Login::loginAdm($obAdmin);
                break;
                
            case 'entrar':
                // Busca Usuário pelo login
                $obUsuario = Usuario::getUsuarioPorCPF($_POST['login']);
    
                // Valida a instância e a senha
                if(!$obUsuario instanceof Usuario || (md5($_POST['senhaUser']) !== $obUsuario->senha)) {
                    echo "<script>alert('Login e/ou senha inválido(s)');</script>";
                    break;
                }

                Login::loginUsuario($obUsuario);
                break;
        }
    }
?>
</html>