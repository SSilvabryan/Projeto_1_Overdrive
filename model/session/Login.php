<?php

    class Login {

        /**
         * Método responsável por Iniciar a Sessão
         * 
         */
        private static function init() {
            // Verifica o Status da Sessão
            if(session_status() !== PHP_SESSION_ACTIVE) {
                // Inicia a Sessão
                session_start();
            }
        }

        /**
         * Método responsável por retornar os Dados do Usuário Logado
         * @return array
         */
        public static function getUsuarioLogado() {
            // Inicia a Sessão
            self::init();

            // Retorna Dados do Usuário
            return self::isLogged() ? $_SESSION['usuario'] : null;
        }

        /**
         * Método responsável por retornar os Dados do Adm Logado
         * @return array
         */
        public static function getAdmLogado() {
            // Inicia a Sessão
            self::init();

            // Retorna Dados do Adm
            return self::isLoggedAdm() ? $_SESSION['usuario_adm'] : null;
        }

        /**
         * Método responsável por Logar um Admin
         * @param Admin $obAdmin
         */
        public static function loginAdm($obAdmin) {
            // Inicia a Sessão
            self::init();

            // Sessão do Adm
            $_SESSION['usuario_adm'] = [
                'id_adm' => $obAdmin->id_adm,
                'nome' => $obAdmin->nome
            ];

            // Redireciona o Adm para o Dashboard
            header('location: admin/dashboard.php');
            exit;
        }

        /**
         * Método responsável por Logar um Usuário
         * @param Usuario $obUsuario 
         */
        public static function loginUsuario($obUsuario) {
            // Inicia a Sessão
            self::init();

            // Sessão do Usuário
            $_SESSION['usuario'] = [
                'id_usuario' => $obUsuario->id_usuario,
                'nome' => $obUsuario->nome,
                'cpf' => $obUsuario->cpf
            ];

            // Redireciona o Usuário para Dashboard
            header('location: usuarioPadrao/dashboardUsuario.php');
            exit;
        }

        /**
         * Método responsável por Deslogar o Adm
         */
        public static function logoutAdm() {
            // Inicia a Sessão
            self::init();

            // Remove a Sessão de Adm
            unset($_SESSION['usuario_adm']);

            // Redireciona o Usuário para Login
            header('location: index.php');
            exit;
        }

        /**
         * Método responsável por Deslogar o Usuário
         */
        public static function logout() {
            // Inicia a Sessão
            self::init();

            // Remove a Sessão de Adm
            unset($_SESSION['usuario']);

            // Redireciona o Usuário para Login
            header('location: index.php');
            exit;
        }
        
        /**
         * Método responsável por Verificar se o Usuário está Logado
         * @return boolean
         */
        public static function isLogged() {
            // Inicia a Sessão
            self::init();

            // Validação da Sessão
            return isset($_SESSION['usuario']['id_usuario']);
        }

        /**
         * Método responsável por Verificar se o Adm está Logado
         * @return boolean
         */
        public static function isLoggedAdm() {
            // Inicia a Sessão
            self::init();

            // Validação da Sessão
            return isset($_SESSION['usuario_adm']['id_adm']);
        }

        /**
         * Método responsável por Obrigar o Adm a estar Logado para Acessar o Dashboard
         */
        public static function requireLoginAdmDash() {
            if(!self::isLoggedAdm()) {
                header('location: ../index.php');
                exit;
            }
        }

        /**
         * Método responsável por Obrigar o Adm a estar Logado para Acessar
         */
        public static function requireLoginAdm() {
            if(!self::isLoggedAdm()) {
                header('location: ../../index.php');
                exit;
            }
        }

        /**
         * Método responsável por Obrigar o Adm a estar Deslogado para Acessar
         */
        public static function requireLogoutAdm() {
            if(self::isLoggedAdm()) {
                header('location: admin\dashboard.php');
                exit;
            }
        }

        /**
         * Método responsável por Obrigar o Usuário a estar Logado para Acessar o Dashboard
         */
        public static function requireLogin() {
            if(!self::isLogged()) {
                header('location: ../index.php');
                exit;
            }
        }

        /**
         * Método responsável por Obrigar o Usuário a estar Deslogado para Acessar
         */
        public static function requireLogout() {
            if(self::isLogged()) {
                header('location: usuarioPadrao\dashboardUsuario.php');
                exit;
            }
        }
    }
