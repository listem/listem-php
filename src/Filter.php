<?php

namespace Devrtips\Listr;

use OutOfBoundsException;
use Devrtips\Listr\Parameter\Simple as DefaultParameterMethod;
use Devrtips\Listr\Support\Collection;
use Devrtips\Listr\Conditions\Conditions;

class Filter extends Collection
{

    protected $entity;
    protected $params;

    public function __construct($entity)
    {
        $this->entity = $entity;
        $this->params = new DefaultParameterMethod;

        $config = Listr::getConfig();

        if (!isset($config[$entity]['filters'])) {
            throw new OutOfBoundsException("Filter group '{$entity}' does not exist.");
        }

        foreach ($config[$entity]['filters'] as $name => $filter) {
            $this->items[] = new Filter\Filter($name, $filter, $this->params);
        }
    }

    public function getFilter($filter)
    {
        try {
            return $this->where('name', $filter)->first();
        } catch (\Exception $e) {
            throw new OutOfBoundsException("Filter '{$filter}' does not exist in '{$this->entity}'.");
        }
    }
        
    /**
     * Return conditions string.
     * 
     * @return string
     */
    public function getConditions()
    {
        $conditions = [];

        foreach ($this as $filter) {
            $conditions[$filter['name']] = $filter->getConditions();
        }

        $conditionsString = Conditions::formatConditions($conditions);

        return ($conditionsString) ? $conditionsString : true;
    }

    public function setParams(array $params)
    {
        $this->params->setFilters($params);

        return $this;
    }
}
