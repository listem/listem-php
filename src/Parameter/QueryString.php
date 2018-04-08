<?php

namespace Listem\Parameter;
use Exception;

class QueryString extends AbstractParameter
{
    protected $params = [];

    public function __construct()
    {
        // if (empty($_GET)) {
        //     throw new Exception('No Parameters are set.');            
        // }
        $this->params = $_GET;
    }

    /**
     * @param array $filters
     * @return  void
     */
    public function setFilters(array $filters)
    {
        $this->params = $filters;
    }

    public function getFilterName($entityName)
    {
        return strtolower($entityName);
    }

    public function getSorterName()
    {
        
    }

    public function getFilterParam($inputName)
    {
        $inputName = str_replace('.', '_', $inputName);

        if (isset($this->params[$inputName])) {
            return $this->params[$inputName];
        }

        return null;
    }

    public function getSorterParam()
    {
        
    }
}
