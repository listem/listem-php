<?php

namespace Devrtips\Listr\Parameter;

class Simple extends AbstractParameter
{
    protected $params = [];

    public function __construct()
    {
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
		if (isset($this->params[$inputName])) {
            return $this->params[$inputName];
        }

        return null;
	}

	public function getSorterParam()
	{
		
	}

}