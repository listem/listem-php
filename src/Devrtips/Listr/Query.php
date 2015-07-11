<?php

namespace Devrtips\Listr;

class Query
{

    /**
     * @var Devrtips\Listr\Query\Filter\FilterQueryInterface
     */
    public static $filterQueryClass;

    /**
     * @var Devrtips\Listr\Query\Sorter\SorterQueryInterface
     */
    public static $sorterQueryClass;

    /**
     * 
     * @return Devrtips\Listr\Query\Filter\FilterQueryInterface
     */
    private static function getFilterQueryClass()
    {
        if (is_null(self::$filterQueryClass)) {

            // Get database type for the queries.
            $databaseType = Config::get()['default']['database'];

            // Instantiate matching parameter class
            $databaseTypeClassname = 'Devrtips\Listr\Query\Filter\\' . ucwords($databaseType);
            self::$filterQueryClass = new $databaseTypeClassname;
        }

        return self::$filterQueryClass;
    }

    /**
     * 
     * @return Devrtips\Listr\Query\Sorter\SorterQueryInterface
     */
    private static function getSorterQueryClass()
    {
        if (is_null(self::$sorterQueryClass)) {

            // Get database type for the queries.
            $databaseType = Config::get()['default']['database'];

            // Instantiate matching parameter class
            $databaseTypeClassname = 'Devrtips\Listr\Query\Sorter\\' . ucwords($databaseType);
            self::$sorterQueryClass = new $databaseTypeClassname;
        }

        return self::$sorterQueryClass;
    }

    /**
     * Get parameters for filters with the given identifier/entity name.
     *
     * @param string $entity
     * @return array
     */
    public static function getFilterConditions($entity)
    {
        return self::getFilterQueryClass()->init($entity);
    }

    /**
     * Get parameters for sorters with the given identifier/entity name.
     *
     * @param string $entity
     * @return array
     */
    public static function getSortOrders($entity)
    {
        return self::getSorterQueryClass()->init($entity);
    }

}
