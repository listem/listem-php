<?php

namespace Devrtips\Listr;

class Config
{

    /**
     * Default filter type, if it is explicitly not defined in the config.
     *
     * @var string
     */
    const DEFAULT_FILTER_TYPE = 'string';

    /**
     * @var array
     */
    public static $items = array(
        'default' => array(
            'parameter' => 'url',
            'database' => 'mysql'
            )
        );

    /**
     * Populate the pacakge configurations array.
     *
     * @param array $items
     */
    public static function set(array $items = array())
    {

        $items['filters'] = self::prepareFilters($items['filters']);

        return self::$items = array_merge_recursive(self::$items, $items);
    }

    public static function prepareFilters(array $items = array())
    {
        // Prepare filters list into a collection.
        foreach ($items as &$entity) {

            // Prepare filters list into a collection.
            foreach ($entity as $identifier => &$filter) {

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

                $preparedFilter = array();

                $preparedFilter['columns'] = $columns;
                $preparedFilter['type'] = $type;
                $preparedFilter['label'] = $label;
                $preparedFilter['placeholder'] = $placeholder;

                $filter = $preparedFilter;
            }
        }

        return $items;
    }

    /**
     * Get package configurations array.
     *
     * @return array
     */
    public static function get()
    {
        return self::$items;
    }


    /**
     * Get filter configurations array.
     *
     * @param string $entity
     * @return array
     */
    public static function getFilters($entity = false)
    {
        $filters = self::get()['filters'];

        // If list of filters for the given entity is not available, throw error.
        if($entity && (!isset($filters[$entity]) || is_null($filters = $filters[$entity]))) {
            throw new Exception("Filters list for '{$this->entity}' not defined in config.");
        }

        return $filters;
    }

}
