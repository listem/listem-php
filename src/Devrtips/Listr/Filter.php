<?php

namespace Devrtips\Listr;

use Devrtips\Listr\Collection\Collection;
use Devrtips\Listr\Builder\Filter as FilterBuilder;
use Exception;

class Filter
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
    protected $filters;

    /**
     * @var array
     */
    protected $config;

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

        $this->filters = $this->getFilters();
    }

    /**
     * Get the list of filters belonging to the entity/identifier.
     *
     * @return Devrtips\Listr\FilterCollection
     */
    public function getFilters()
    {
        if (is_null($this->filters)) {

            $filtersList = $this->getFiltersListFromConfig();
            $list = [];

            // Prepare filters list into a collection.
            foreach ($filtersList as $identifier => $filter) {

                $item = [];

                // Break identifier (filter list array key) into seperate values.
                // Identifier pattern is 'column_name|filter_type'.
                $identifierValues = explode('|', $identifier);

                // Get table column name(s). Can be a single column (string) or multiple (array).
                $columns = (isset($filter['column'])) ? $filter['column'] : $identifierValues[0];

                // Populate column(s) as an array to maintain uniformity.
                $item['columns'] = is_array($columns) ? $columns : [$columns];

                $item['type'] = (isset($filter['type'])) ? $filter['type'] : (isset($identifierValues[1]) ? $identifierValues[0] : self::DEFAULT_FILTER_TYPE);

                $item['label'] = $filter['label'];

                $item['placeholder'] = (isset($filter['placeholder'])) ? $filter['placeholder'] : $filter['label'];

                $list[] = $this->getNewFilterBuilder($item);
            }

            $this->filters = Collection::make($list);
        }

        return $this->filters;
    }

    /**
     * Return new FilterBuilder instance. If an array is passed, populate the existing
     * properties of the instance with them.
     *
     * @param array $properties
     * @return \Devrtips\Listr\Builder\FilterBuilder
     */
    protected function getNewFilterBuilder(array $properties = [])
    {
        $filter = new FilterBuilder();

        // If a list of properties were passed, populate item,
        if (is_array($properties) && !empty($properties)) {

            // Iterate through the array to see if matching properties exists in the object.
            foreach ($properties as $key => $value) {
                // If exists, popupate them with array values.
                if (property_exists($filter, $key)) {
                    $filter->{$key} = $value;
                }
            }
        }

        return $filter;
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

}
