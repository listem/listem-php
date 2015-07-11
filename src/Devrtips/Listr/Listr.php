<?php

/**
 * @author      Malitta Nanayakkara <malitta@gmail.com>
 * @copyright   2015 Malitta Nanayakkara
 * @link        http://devr.tips/packages/listr
 * @license     http://opensource.org/licenses/MIT
 */

namespace Devrtips\Listr;

/**
 * Listr
 * 
 * Listr provides an easy API to generate filters and sorters for data lists and 
 * converts the filtering / sorting parameters into query objects which 
 * enables you to easily query any type of database with ease.
 *
 * This acts as a factory class for the underlying Filter and Sorter classes
 * and provides facades to some methods belonging those classes, for easy access.
 *
 * @package Devrtips\Listr
 */
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
    public function initFiltersAndSorters($entity)
    {
        $this->filters = $this->initFilters($entity);
        $this->sorters = $this->initSorters($entity);

        return $this;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Filter
     */
    public function initFilters($entity)
    {
        $this->filters = new Filter($this->config['filters'], $entity);

        return $this->filters;
    }

    /**
     * Initialize sorters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Sorter
     */
    public function initSorters($entity)
    {
        $this->sorters = new Sorter($entity);

        return $this->sorters;
    }

    /**
     * Ret
     * 
     * @return Devrtips\Listr\Query\Filter\FilterQueryInterface
     */
    public function getQuery()
    {
        return $this->filters->getQuery();
    }

    /**
     * Ret
     * 
     * @return Devrtips\Listr\Query\Sorter\SorterQueryInterface
     */
    public function getOrder()
    {
        return $this->sorters->getOrder();
    }

    /**
     * Get other (non listr) query string parameters to be set as hidden inputs
     * inside the form to be passed in to the next request when the form is submitted.
     *
     * @return string
     */
    public function nonListerQueryParameters()
    {
        return Helpers\Html::queryStringParams();
    }

}
