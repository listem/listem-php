<?php

namespace Devrtips\Listr;

use Devrtips\Listr\Collection\FilterCollection;
use Collection\SorterCollection;

class Listr
{

    /**
     * @var Devrtips\Listr\Filter
     */
    public $filter;

    /**
     * @var Devrtips\Listr\Sorter
     */
    public $sorter;

    /**
     * Contains the configurations for filters and sorters.
     *
     * @var array
     */
    protected $config;

    /**
     * Initialize the class by populating the config array.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Initialize filters and sorters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Listr
     */
    public function getFiltersAndSorters($entity)
    {
        $this->filters = $this->getFilters($entity);

        return $this;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\FiltersList
     */
    public function getFilters($entity)
    {
        $this->filters = new Filter($this->config['filters'], $entity);

        return $this->filters;
    }

}
