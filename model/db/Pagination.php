<?php

    class Pagination {

        /**
         * número máximo de Registros por página
         * @var integer
         */
        private $limit;

        /**
         * Quantidade total de Resultados do Banco
         * @var Integer
         */
        private $results;

        /**
         * Quantidade de páginas
         * @var Integer
         */
        private $pages;

        /**
         * Página Atual
         * @var Integer
         */
        private $currentPage;

        /**
         * Construtor da Classe
         * @param Integer $results
         * @param Integer $currentPage
         * @param Integer $limit
         */
        public function __construct($results, $currentPage = 1, $limit = 4) {
            $this->results = $results;
            $this->limit = $limit;
            $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
            $this->calculate();
        }

        /**
         * Método responsável por Calcular a Paginação
         */
        private function calculate() {
            // Calcula o Total de Páginas
            $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

            // Verifica se a Página Atual não excede o número de Páginas
            $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
        }

        /**
         * Método responsável por retornar a Cláusula Limit
         * @return String
         */
        public function getLimit() {
            $offset = ($this->limit * ($this->currentPage - 1));

            return $offset.','.$this->limit;
        }

        /**
         * Método responsável por Retornar as Opções de Páginas disponíveis
         * @return array
         */
        public function getPages() {
            // Não Retorna Páginas
            if($this->pages == 1) 
                return [];

            // Páginas
            $paginas = [];
            for($i = 1; $i <= $this->pages; $i++) {
                $paginas[] = [
                    'pagina' => $i,
                    'atual'  => $i == $this->currentPage
                ];
            }
            return $paginas;
        }
    }
?>