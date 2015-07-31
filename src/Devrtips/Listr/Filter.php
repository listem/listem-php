<?php

/**
 * @author      Malitta Nanayakkara <malitta@gmail.com>
 * @copyright   2015 Malitta Nanayakkara
 * @link        http://devr.tips/packages/listr
 * @license     http://opensource.org/licenses/MIT
 */

namespace Devrtips\Listr;

use Devrtips\Listr\Collection\Collection;
use Devrtips\Listr\Builder\FilterBuilder;
use Exception;

class Filter extends Collection
{

    /**
     * Name of the entity which the filters belong to. Also known as identifier.
     *
     * @var string
     */
    protected $entity;

    /**
     * List of filters.
     *
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $items;

    /**
     * @var array
     */
    protected $config;


    public static $queryClass;

    public function __construct($entity)
    {
        $this->config = Config::get();
        $this->entity = $entity;
        $this->items = $this->getFilters();
    }

    /**
     * Get the list of filters belonging to the entity/identifier.
     *
     * @return Devrtips\Listr\FilterCollection
     */
    protected function getFilters()
    {
        if (is_null($this->items)) {

            $filtersList = Config::getFilters($this->entity);
            $list = [];

            // Prepare filters list into a collection.
            foreach ($filtersList as $identifier => $filter) {

                // Create new filter using the gathered config values.
                $list[] = new FilterBuilder($this->entity, $identifier, $filter['columns'], $filter['type'], $filter['label'], $filter['placeholder']);
            }

            $this->items = $list;
        }

        return $this->items;
    }

    /**
     * Return the list of default parameters for filters defined in config.
     *
     * @return array
     */
    protected function getDefaultConfig()
    {
        return $this->config['default'];
    }

    public function getQuery()
    {
        return Query::getFilterConditions($this->items);
    }

}
