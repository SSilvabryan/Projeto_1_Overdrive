<?php
    require_once ("model/session/Login.php");

    if(isset($_GET['cpf'])) {
        //Desloga o Usuário
        Login::logout();
    } else {
        //Desloga o Adm
        Login::logoutAdm();
    }