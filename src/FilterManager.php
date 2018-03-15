<?php

namespace Listem;

use OutOfBoundsException;
use Listem\Parameter\Simple as DefaultParameterMethod;
use Listem\Conditions\ConditionManager;
use Listem\Support\Collection;
use Listem\Filter\Filter;

class FilterManager
{
    protected $filters;
    protected $params;
    protected $dbDriver;

    public function __construct($config, $dbDriver, $params)
    {
        $this->params = $params;
        $this->dbDriver = $dbDriver;

        if (!isset($config['filters'])) {
            throw new OutOfBoundsException("Filter group does not exist.");
        }

        $filters = [];
        foreach ($config['filters'] as $name => $filter) {
            $filters[] = new Filter($name, $filter, $this->params);
        }

        $this->filters = new Collection($filters);
    }

    public function getFilter($filterName)
    {
        try {
            return $this->filters
                ->where('name', $filterName)
                ->first();
        } catch (\Exception $e) {
            throw new OutOfBoundsException("Filter '{$filterName}' does not exist.");
        }
    }

    public function setDefaultValue($filterName, $value)
    {
        return $this->getFilter($filterName)
            ->setDefault($value);
    }
        
    /**
     * Return conditions string.
     *
     * @return string
     */
    public function getConditions()
    {
        $conditions = [];

        foreach ($this->filters as $filter) {
            $conditions[$filter['name']] = $filter->getConditions();
        }

        $conditionManager = new ConditionManager($this->dbDriver);
        $conditionsString = $conditionManager->formatConditions($conditions);

        return ($conditionsString) ? $conditionsString : true;
    }

    public function setParams(array $params)
    {
        $this->params->setFilters($params);

        return $this;
    }
}
