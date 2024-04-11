<?php
    require_once ("model/Usuario.php");
    require_once ("model/Admin.php");

    // Validação do POST
    if(isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'entrarAdmin':
                // Busca Adm pelo login
                $obAdmin = Admin::getAdmPorLogin($_POST['usuario']);

                // Valida a instância e a senha
                if(!$obAdmin instanceof Admin || ($_POST['senha'] !== $obAdmin->senha)) {
                    $alertaLogin = 'Login e/ou senha inválido(s)';
                    header('location: index.php');
                    break;
                }
                echo "<pre>"; print_r($obAdmin); echo "</pre>"; exit;
                break;

            case 'entrar':
                // Busca Usuário pelo cpf
                $obUsuario = Usuario::getUsuarioPorCPF($_POST['login']);
                
                // Valida a instância e a senha
                if(!$obUsuario instanceof Usuario || ($_POST['senha'] !== $obUsuario->senha)) {
                    echo "<script>alert('CPF e/ou senha inválido(s)');</script>";
                    header('location: indexUsuarioPadrao.php');
                    break;
                }
                echo "<pre>"; print_r($obUsuario); echo "</pre>"; exit;
                break;
        }
    }
?>

    