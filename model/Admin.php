<?php

require_once ("db/DataBase.php");

class Admin {

    /**
     * ID do Administrador
     * @var String
     */
    public $id_adm;

    /**
     * Nome do Administrador
     * @var String
     */
    public $nome;

    /**
     * Login do Administrador
     * @var String
     */
    public $login;

    /**
     * Senha do Administrador
     * @var String
     */
    public $senha;

    public static function getAdmPorLogin($login) {
        return (new DataBase('usuario_adm')) -> select('login = "' .$login. '"') 
                                             -> fetchObject(self::class);
    }
}