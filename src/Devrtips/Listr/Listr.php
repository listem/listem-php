<?php

namespace Devrtips\Listr;

class Listr
{

    /**
     * @var Devrtips\Listr\Filter
     */
    public $filters;

    /**
     * @var Devrtips\Listr\Sorter
     */
    public $sorters;

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
        $this->config = Config::set($config);
    }

    /**
     * Initialize filters and sorters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Listr
     */
    public function setFiltersAndSorters($entity)
    {
        $this->filters = $this->setFilters($entity);

        return $this;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\FiltersList
     */
    public function setFilters($entity)
    {
        $this->filters = new Filter($this->config['filters'], $entity);

        return $this->filters;
    }

}
