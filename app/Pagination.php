<?php 

namespace App;

/**
 * Classe pagination
 */
class Pagination 
{
    /**
     * Limite da pagina
     *
     * @var integer
     */
    public $limit;

    /**
     * Resultados
     *
     * @var integer
     */
    public $results;

    /**
     * Pagina atual
     *
     * @var integer
     */
    public $pages;

    /**
     * Pagina atual
     *
     * @var integer
     */
    public $currentPage;

    function __construct($results, $currentPage = 1, $limit = 10)
    {
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }



    /**
     * Calcula o total de paginas
     *
     * @return void
     */
    private function calculate()
    {
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }


    /**
     * Retorna limite
     *
     * @return void
     */
    function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Retorna dados da pagina
     *
     * @return array
     */
    function getPages()
    {
        if ($this->pages == 1) return [];

        $pages = [];

        for($i = 0; $i <= $this->pages; $i++)
        {
            $pages[] = [
                "page"    => $i,
                "current" => $i == $this->currentPage
            ];
        }
        return $pages;
    }
}