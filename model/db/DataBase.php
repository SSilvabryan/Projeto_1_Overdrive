<?php

    class DataBase {

        /**
         * HOST de conexão com o Banco de Dados
         *  @var String
         */
        const HOST = 'localhost';

        /**
         * Nome do Banco de Dados
         * @var String
         */
        const NAME = 'crud-overdrive';

        /**
         * Usuário do Banco
         * @var String
         */
        const USER = 'root';

        /**
         * Senha de acesso ao Banco 
         * @var String
         */
        const PASS = '';

        /**
         * Nome da Tabela a ser manipulada
         * @var String
         */
        private $table;

        /**
         * Instância de conexão com o Banco
         * @var PDO
         */
        private $connection;

        /**
         * Define a tabela
         * @param String table
         */
        public function __construct($table = null) {
            $this->table = $table;
            $this->setConnection();
        }

        /**
         * Método responsável por criar uma conexão com o Banco
         */
        private function setConnection() {
            try{
                $this->connection = new PDO('mysql:host='. self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                die('ERROR: ' . $e->getMessage());
            }
        }

        /**
         * Método responsável por executar Queries dentro do Banco de Dados
         * @param String $query
         * @param String $params
         * @return PDOStatement
         */
        public function execute($query, $params = []) {
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            } catch(PDOException $e){
                die('ERROR: ' . $e->getMessage());
            }
        }

        /**
         * Método responsável por Inserir Dados no Banco
         * @param array $values [ field => value ]
         * @return integer ID inserido
         */
        public function insert($values) {
            // Dados da Query
            $fields = array_keys($values);
            $binds = array_pad([], count($fields), '?');

            // Monta a Query
            $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

            // Executa o Insert
            $this->execute($query, array_values($values));

            // Retorna o ID inserido
            return $this->connection->lastInsertId();
        }

        /**
         * Método responsável por Executar uma Consulta no Banco
         * @param String $where
         * @param String $order
         * @param String $limit
         * @param String $fields
         * @return PDOStatement
         */
        public function select($where = null, $order = null, $limit = null, $fields = '*') {
            // Dados da Query
            $where = strlen($where) ? 'WHERE ' .$where : '';
            $order = strlen($order) ? 'ORDER BY ' .$order : '';
            $limit = strlen($limit) ? 'LIMIT ' .$limit : '';

            // Monta a Query
            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit.'';

            // Executa a Query
            return $this->execute($query);
        }

        /**
         * Método responsável por Executar uma Consulta das Empresas no Banco
         * @param String $where
         * @return PDOStatement
         */
        public function selectCompanies($where = null, $fields = '*') {
            // Dados da Query
            $where = strlen($where) ? 'WHERE ' .$where : '';

            // Monta a Query
            $query = 'SELECT id_company, nome_fantasia FROM '.$this->table.' '.$where.'ORDER BY nome_fantasia';

            // Executa a Query
            return $this->execute($query);
        }

        /**
         * Método responsável por executar atualizações no Banco de Dados
         * @param String $where
         * @param array $values [ field => value ]
         * @return boolean
         */
        public function update($where, $values) {
            // Dados da Query
            $fields = array_keys($values);
            
            // Monta a Query
            $query = 'UPDATE '.$this->table.' SET ' .implode('=?,', $fields). '=? WHERE ' .$where;

            // Executa a Query
            $this->execute($query, array_values($values));

            // Retorna Sucesso
            return true;
        }

        /**
         * Método responsável por Deletar um Usuário
         * @param String $where
         * @return boolean
         */
        public function delete($where) {
            // Monta a Query 
            $query = 'DELETE FROM '.$this->table.' WHERE ' .$where;

            // Executa a Query
            $this->execute($query);

            // Retorna Sucesso
            return true;
        }  
        
        /**
         * Método responsável por Deletar uma Empresa
         * @param String $where
         * @return boolean
         */
        public function deleteCompany($where) {
            //Monta a Query responsável por captar se existem funcionários na Empresa
            $queryUsers = 'SELECT * FROM usuario WHERE ' .$where;
            if($this->execute($queryUsers)->fetchAll(PDO::FETCH_CLASS, self::class))
                return false;
            //
            // Monta a Query 
            $query = 'DELETE FROM '.$this->table.' WHERE ' .$where;

            // Executa a Query
            $this->execute($query);

            // Retorna Sucesso
            return true;
        }  
    }

?>