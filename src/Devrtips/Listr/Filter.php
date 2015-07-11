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


    /**
     * Default filter type, if it is explicitly not defined in the config.
     *
     * @var string
     */
    const DEFAULT_FILTER_TYPE = 'string';

    public function __construct(array $config, $entity)
    {
        $this->config = $config;
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

            $filtersList = $this->getFiltersListFromConfig();
            $list = [];

            // Prepare filters list into a collection.
            foreach ($filtersList as $identifier => $filter) {

                $entity = $this->entity;

                // Break identifier (filter list array key) into seperate values.
                // Identifier pattern is 'column_name|filter_type'.
                $identifierValues = explode('|', $identifier);

                // Get table column name(s). Can be a single column (string) or multiple (array).
                $column = (isset($filter['column'])) ? $filter['column'] : $identifierValues[0];

                // Populate column(s) as an array to maintain uniformity.
                $columns = is_array($column) ? $column : [$column];

                $type = (isset($filter['type'])) ? $filter['type'] : (isset($identifierValues[1]) ? $identifierValues[1] : self::DEFAULT_FILTER_TYPE);

                $label = $filter['label'];

                $placeholder = (isset($filter['placeholder'])) ? $filter['placeholder'] : $filter['label'];

                // Create new filter using the gathered config values.
                $list[] = new FilterBuilder($entity, $identifier, $columns, $type, $label, $placeholder);
            }

            $this->items = $list;
        }

        return $this->items;
    }

    /**
     * Return the list of filters defined in config for the given identifier/entity name.
     *
     * @return array
     * @throws Exception
     */
    protected function getFiltersListFromConfig()
    {
        // If list of filters for the given entity is not available, throw error.
        if (!isset($this->config[$this->entity]) || is_null($config = $this->config[$this->entity])) {
            throw new Exception("Filters list for '{$this->entity}' not defined in config.");
        }

        return $config;
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
        return Query::getFilterConditions($this->entity);
    }

}
