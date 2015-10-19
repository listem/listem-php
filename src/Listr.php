<?php

/**
 * @author      Malitta Nanayakkara <malitta@gmail.com>
 * @copyright   2015 Malitta Nanayakkara
 * @link        http://devr.tips/packages/listr
 * @license     http://opensource.org/licenses/MIT
 */

namespace Devrtips\Listr;

use Devrtips\Listr\Filter as FilterBuilder;
use Devrtips\Listr\Support\Collection;
use Devrtips\Listr\Support\Config;

/**
 * Listr
 *
 * Listr provides an easy API to generate filters and sorters for data lists and
 * converts the filtering / sorting parameters into query objects which
 * enables you to easily query any type of database with ease.
 *
 * This acts as a factory class for the underlying Filter and Sorter classes
 * and provides facades to some methods belonging those classes for easy access.
 *
 * @package Devrtips\Listr
 */
class Listr
{
    /**
     * @var Devrtips\Listr\Support\Config
     */
    public static $config;

    /**
     * @var Devrtips\Listr\Filter
     */
    public static $filters = array();

    /**
     * @var Devrtips\Listr\Sorter
     */
    public static $sorters = array();

    /**
     * Initialize the class by populating the config array.
     *
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        self::$config = new Config($config);
    }

    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Filter
     */
    public static function getFilters($entity)
    {
        if (!isset(self::$filters[$entity])) {
            self::$filters[$entity] = new FilterBuilder($entity);
        }

        return self::$filters[$entity];
    }

    /**
     * Initialize sorters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Sorter[]
     */
    public function getSorters($entity)
    {
        // if (!isset(self::$sorters[$entity])) {
        //     self::$filters[$entity][] = new Filter;
        // }

        // return self::$sorters[$entity];
    }


    /**
     * TODO: helper
     * Get other (non listr) query string parameters to be set as hidden inputs
     * to be passed in to the next request when the form is submitted.
     *
     * @return string
     */
    public function nonListrQueryParameters()
    {
        return Helpers\Html::queryStringParams();
    }
}
