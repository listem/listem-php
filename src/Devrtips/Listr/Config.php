<?php

namespace Devrtips\Listr;

class Config
{

    /**
     * @var array
     */
    public static $items = array(
        'default' => array(
            'parameter' => 'url'
        )
    );

    /**
     * Populate the pacakge configurations array.
     *
     * @param array $items
     */
    public static function set(array $items = array())
    {
        return self::$items = array_merge_recursive(self::$items, $items);
    }

    /**
     * Get pacakge configurations array.
     *
     * @return array
     */
    public static function get()
    {
        return self::$items;
    }

}
