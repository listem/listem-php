<?php

namespace Devrtips\Listr;

use Devrtips\Listr\Parameter\Simple as DefaultParameterMethod;
use Devrtips\Listr\Support\Collection;

class Filter extends Collection
{
    public function __construct($entity)
    {
        $config = Listr::getConfig();

        foreach ($config[$entity]['filters'] as $name => $filter) {
            $this->items[] = new Filter\Filter($name, $filter, new DefaultParameterMethod);
        }
    }

    public function getFilter($filter)
    {
        return $this->where('name', $filter)->first();
    }
        
    public function getConditions()
    {
        return array();
    }
}
