<?php

namespace Devrtips\Listr\Query\Filter;

use Devrtips\Listr\Parameter;
use Devrtips\Listr\Config;

class Mysql implements FilterQueryInterface
{

	public function init($entity)
	{

		// Get filter parameters
        $parameters = Parameter::getFilterParameters($entity);

		echo '<pre>', print_r($entity, true);
		echo '<pre>', print_r(Config::get()['filters'][$entity], true);
		echo '<pre>', print_r($parameters, true);
		exit;
		return $this;	
	}

	public function getConditions()
	{
		return $this;
	}

	public function toString()
	{

	}	

}