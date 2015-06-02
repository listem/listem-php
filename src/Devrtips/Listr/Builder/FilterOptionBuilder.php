<?php

namespace Devrtips\Listr\Builder;

use Devrtips\Listr\Collection\Collection;

class FilterOptionBuilder
{

    /**
     * List of filter options for each filter type.
     *
     * @var array
     */
    public static $options = array(
        'string' => array(
            'contains',
            'equals',
        ),
        'boolean' => array(
            'equals',
        ),
        'date' => array(
            'between',
            'from',
            'to'
        ),
        'time' => array(
            'between',
            'from',
            'to'
        ),
        'radio' => array(
            'equals'
        )
    );

    /**
     * Get filter options collection for the given filter type.
     *
     * @param string $type
     * @param string $identifier
     * @return \Devrtips\Listr\Collection\Collection
     */
    public static function getOptions($type, $entity, $identifier)
    {
        // Todo - Get default option for the filter from config using identifier
        $default = null;

        $optionInstancesList = array();

        foreach (self::$options[$type] as $key => $option) {

            // If no default option is set, mark the first option as the default.
            // Or else mark the matching default option as the default.
            $defaultOption = (is_null($default) && $key == 0) ? true : (($default == $option) ? true : false);

            $optionsClassname = 'Devrtips\Listr\Builder\FilterOption\\' . ucwords($type) . ucwords($option);

            // Instanciate new filter option and add it to list.
            $optionInstancesList[] = new $optionsClassname($defaultOption, $entity, $identifier);
        }

        // Generate a collection with the options list array.
        $options = new Collection($optionInstancesList);

        return $options;
    }

}
