<?php

namespace Devrtips\Listr\Parameter;

class Simple extends AbstractParameter
{
	public function getFilterName($entityName)
	{
		return strtolower($entityName);
	}

	public function getSorterName()
	{
		
	}

	public function getFilterParam($inputName)
	{
		if (isset($_GET[$inputName])) {
            return $_GET[$inputName];
        }

        return null;
	}

	public function getSorterParam()
	{
		
	}

}