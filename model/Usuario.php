<?php
    
    require_once ("db\DataBase.php");

    class Usuario {

        /**
         * Identificador do usuário
         * @var integer
         */
        public $id_usuario;

        /**
         * Nome do Usuário
         * @var String
         */
        public $nome;

        /**
         * CPF do Usuário
         * @var String
         */
        public $cpf;

        /**
         * CNH do Usuário
         * @var String
         */
        public $cnh;

        /**
         * Telefone do Usuário
         * @var String
         */
        public $telefone;

        /**
         * Endereco do Usuário
         * @var String
         */
        public $endereco;
        
        /**
         * Carro do Usuário
         * @var String
         */
        public $carro;

        /**
         * Empresa do Usuário
         * @var String
         */
        public $empresa;

        /**
         * Senha do Usuário
         * @var String
         */
        public $senha;

        /**
         * ID da Empresa do Usuário
         * @var String
         */
        public $id_company;

        /**
         * Método responsável por Cadastrar um Novo Usuário
         * @return boolean
         */
        public function cadastrarUsuario() {
            // Inserir Usuário no Banco
            $obDataBase = new DataBase('usuario');

            $this->id_usuario = $obDataBase->insert([
                'nome' => $this->nome,
                'cpf' => $this->cpf,
                'cnh' => $this->cnh,
                'telefone' => $this->telefone,
                'endereco' => $this->endereco,
                'carro' => $this->carro,
                'empresa' => $this->empresa,
                'senha' => $this->senha,
                'id_company' => $this->id_company
            ]);

            
            // Retornar sucesso
            return true;
        }

        /**
         * Método responsável por atualizar o Usuário no Banco
         * @return boolean
         */
        public function atualizarUsuario() {
            return (new DataBase('usuario')) -> update('id_usuario = ' .$this->id_usuario, [
                'nome' => $this->nome,
                'cpf' => $this->cpf,
                'cnh' => $this->cnh,
                'telefone' => $this->telefone,
                'endereco' => $this->endereco,
                'carro' => $this->carro,
                'empresa' => $this->empresa,
                'senha' => $this->senha,
                'id_company' => $this->id_company
            ]);
        }

        /**
         * Método responsável por excluir o Usuário do Banco
         * @return boolean
         */
        public function excluirUsuario() {
            return (new DataBase('usuario')) -> delete('id_usuario = ' .$this->id_usuario);
        }

        /**
         * Método responsável por obter os Usuários dentro do Banco de Dados
         * @param String $where
         * @param String $order
         * @param String $limit
         * @return array
         */
        public static function getUsuarios($where = null, $order = null, $limit = null) {
            return (new DataBase('usuario')) -> select($where, $order, $limit)
                                             -> fetchAll(PDO::FETCH_CLASS, self::class);              
        }

        /**
         * Método responsável por obter a Quantidade de Usuários no Banco de Dados
         * @param $where
         * @return Integer
         */
        public static function getQtdUsuarios($where = null) {
            return (new DataBase('usuario')) -> select($where, null, null, 'COUNT(*) as qtd')
                                             -> fetchObject()
                                             -> qtd;           
        }

        /**
         * Método responsável por buscar um Usuário pelo seu ID
         * @param integer $id_usuario
         * @return Usuario
         */
        public static function getUsuario($id_usuario) {
            return (new DataBase('usuario')) -> select('id_usuario = ' .$id_usuario)
                                             -> fetchObject(self::class);
        }

        /**
         * Método responsável por buscar um Usuário pelo seu CPF
         * @param $cpf
         * @return Usuario
         */
        public static function getUsuarioPorCPF($cpf) {
            return (new DataBase('usuario')) -> select('cpf = "' .$cpf. '"') 
                                             -> fetchObject(self::class);
        }
    }
