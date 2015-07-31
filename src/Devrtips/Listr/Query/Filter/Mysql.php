<?php

namespace Devrtips\Listr\Query\Filter;

use Devrtips\Listr\Parameter;
use Devrtips\Listr\Config;

class Mysql extends AbstractFilterQuery implements FilterQueryInterface
{

	public function getConditions()
	{
		$conditionStrings = array();
		
		// Iterate through filters.
		foreach($this->conditions as $filter){

			$columnConditions = array();

			// Assume that the glue is OR, if not specified.
			$glue = 'OR';

			if(isset($filter['OR'])){
				$filter = $filter['OR'];
			}

			if(isset($filter['AND'])){
				$filter = $filter['AND'];
				$glue = 'AND';
			}

			// Iterate through columns belonging to a filter.
			foreach($filter as $field){
				$columnConditions[] = "`{$field[0]}` {$field[1]} '{$field[2]}'";	
			}

			$conditionStrings[] = '(' . implode(' ' . $glue . ' ', $columnConditions) . ')';
		}

		return implode(' AND ', $conditionStrings);
	}

	public function toString(){

	}
}