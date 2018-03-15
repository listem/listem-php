<?php

/**
 * @author      Malitta Nanayakkara <malitta@gmail.com>
 * @copyright   2015 Malitta Nanayakkara
 * @link        https://listem.co
 * @license     http://opensource.org/licenses/MIT
 */

namespace Listem;

use Listem\FilterManager;
use Listem\Support\Collection;
use Listem\Support\Config;

/**
 * List
 *
 * Listem provides an easy API to generate filters and sorters for data lists and
 * converts the filtering / sorting parameters into query objects which
 * enables you to easily query any type of database with ease.
 *
 * This acts as a factory class for the underlying Filter and Sorter classes
 * and provides facades to some methods belonging those classes for easy access.
 *
 * @package Listem
 */
class ListEntity
{
    /**
     * @var Listem\Support\Config
     */
    private $config;

    /**
     * @var Listem\Filter
     */
    private $filter;

    /**
     * @var Listem\Filter
     */
    public static $filters = array();

    /**
     * @var Listem\Sorter
     */
    public static $sorters = array();

    /**
     * Initialize the class by populating the config array.
     *
     * @param array $config
     */
    public function __construct($config, $dbDriver, $params)
    {
        $this->config = new Config($config);
        $this->filter = new FilterManager($this->config, $dbDriver, $params);
    }

    /**
     * Initialize filters for the given entity.
     *
     * @return Listem\Support\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @return Listem\Filter
     */
    public function getFilters()
    {
        return $this->filter;
    }

    /**
     * Initialize sorters for the given entity.
     *
     * @param string $entity
     * @return Listem\Sorter[]
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
     * Get other (non Listem) query string parameters to be set as hidden inputs
     * to be passed in to the next request when the form is submitted.
     *
     * @return string
     */
    public function nonListemQueryParameters()
    {
        return Helpers\Html::queryStringParams();
    }
}
