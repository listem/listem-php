<?php

namespace Devrtips\Listr;

use OutOfBoundsException;
use Devrtips\Listr\Parameter\Simple as DefaultParameterMethod;
use Devrtips\Listr\Support\Collection;
use Devrtips\Listr\Conditions\Conditions;

class Filter extends Collection
{

    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;

        $config = Listr::getConfig();

        if (!isset($config[$entity]['filters'])) {
            throw new OutOfBoundsException("Filter group '{$entity}' does not exist.");
        }

        foreach ($config[$entity]['filters'] as $name => $filter) {
            $this->items[] = new Filter\Filter($name, $filter, new DefaultParameterMethod);
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
        
    public function getConditions()
    {
        $conditions = [];

        foreach ($this as $filter) {
            $conditions[$filter['name']] = $filter->getConditions();
        }

        return Conditions::formatConditions($conditions);
    }
}
