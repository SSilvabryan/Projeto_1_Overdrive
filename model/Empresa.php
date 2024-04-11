<?php

    require_once ("db/DataBase.php");

    class Empresa {

        /**
         * Identificador da Empresa
         * @var integer
         */
        public $id_company;

        /**
         * Nome Completo da Empresa
         * @var String
         */
        public $nome;

        /**
         * Nome Fantasia da Empresa
         * @var String
         */
        public $nome_fantasia;

        /**
         * CNPJ da Empresa
         * @var String
         */
        public $cnpj;

        /**
         * Endereço da Empresa
         * @var String 
         */
        public $endereco;

        /**
         * Telefone da Empresa
         * @var String
         */
        public $telefone;

        /**
         * Responsável pela Empresa
         * @var String
         */
        public $responsavel;

        /**
         * Método responsável por Cadastrar uma Nova Empresa 
         * @return boolean
         */
        public function cadastrarEmpresa() {
            // Inserir Usuário no Banco
            $obDataBase = new DataBase('empresa');

            $this->id_usuario = $obDataBase->insert([
                'nome' => $this->nome,
                'nome_fantasia' => $this->nome_fantasia,
                'cnpj' => $this->cnpj,
                'endereco' => $this->endereco,
                'telefone' => $this->telefone,
                'responsavel' => $this->responsavel
            ]);

            // Retornar sucesso
            return true;
        }

        /**
         * Método responsável por atualizar a Empresa no Banco
         * @return boolean
         */
        public function atualizarEmpresa() {
            return (new DataBase('empresa')) -> update('id_company = ' .$this->id_company, [
                'nome' => $this->nome,
                'nome_fantasia' => $this->nome_fantasia,
                'cnpj' => $this->cnpj,
                'endereco' => $this->endereco,
                'telefone' => $this->telefone,
                'responsavel' => $this->responsavel
            ]);
        }

        /**
         * Método responsável por excluir a Empresa do Banco
         * @return boolean
         */
        public function excluirEmpresa() {
            return (new DataBase('empresa')) -> deleteCompany('id_company = ' .$this->id_company);
        }

        /**
         * Método responsável por obter as Empresas dentro do Banco de Dados
         * @param String $where
         * @param String $order
         * @param String $limit
         * @return array
         */
        public static function getEmpresas($where = null, $order = null, $limit = null) {
            return (new DataBase('empresa')) -> select($where, $order, $limit)
                                             -> fetchAll(PDO::FETCH_CLASS, self::class);              
        }

        /**
         * Método responsável por obter a Quantidade de Empresas no Banco de Dados
         * @return Integer
         */
        public static function getQtdEmpresas($where = null) {
            return (new DataBase('empresa')) -> select($where, null, null, 'COUNT(*) as qtd')
                                             -> fetchObject()
                                             -> qtd;           
        }

        /**
         * Método responsável por buscar uma Empresa pelo seu ID
         * @param integer $id_usuario
         * @return Usuario
         */
        public static function getEmpresa($id_company) {
            return (new DataBase('empresa')) -> select('id_company = ' .$id_company)
                                             -> fetchObject(self::class);
        }

        /**
         * Método responsável por buscar uma Empresa pelo seu CNPJ
         * @param $cnpj
         * @return Empresa
         */
        public static function getEmpresaPorCNPJ($cnpj) {
            return (new DataBase('empresa')) -> select('cnpj = "' .$cnpj. '"') 
                                             -> fetchObject(self::class);
        }

    }

