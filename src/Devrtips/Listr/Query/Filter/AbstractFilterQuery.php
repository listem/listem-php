<?php

namespace Devrtips\Listr\Query\Filter;

use Devrtips\Listr\Parameter;
use Devrtips\Listr\Config;

abstract class AbstractFilterQuery
{

	/**
	 * List of conditions for the given entity filters.
	 * 
	 * @var array
	 */
	protected $conditions = array();


  /**
   * Convert filter parameters to generic database conditions.
   * 
   * @param Devrtips\Listr\Collection\Collection $filters
   * @return void
   */
	public function init(array $filters)
	{

      $this->conditions = array();

      foreach($filters as $filter){

          $activeFilterOption = $filter['options']->where('active', true);

          if(!count($activeFilterOption)){
              continue;
          }

          $params = $activeFilterOption->first()['parameters'];
          $params = (is_array($params)) ? array_filter($params) : $params;

          if(empty($params) || $params == ''){
              continue;
          }
          
          $this->conditions[] = $activeFilterOption->first()->getQuery();
      }

      return $this->conditions;
	}

}