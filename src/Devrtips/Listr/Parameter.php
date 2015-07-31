<?php

namespace Devrtips\Listr;

class Parameter
{

    /**
     * @var Devrtips\Listr\Parameter\ParameterInterface
     */
    public static $parameterClass;

    private static function getParameterClass()
    {
        if (is_null(self::$parameterClass)) {

            // Get parameter type for filters.
            $parameterType = Config::get()['default']['parameter'];

            // Instantiate matching parameter class
            $parameterTypeClassname = 'Devrtips\Listr\Parameter\\' . ucwords($parameterType);
            self::$parameterClass = new $parameterTypeClassname;
        }

        return self::$parameterClass;
    }

    /**
     * Get parameters for filters with the given identifier/entity name.
     *
     * @param bool $filter
     * @param string $entity
     */
    public static function getFilterParameters($entity, $filter = false)
    {
        $parameters = self::getParameterClass()->getFilterParameters($entity);

        // Remove empty parameters.
        if ($filter) {
            $parameters = array_filter($parameters, function($val) {
                return ((($val || $val === 0 || $val === '0') 
                    && !is_array($val)) || (is_array($val) && !empty(array_filter($val))));
            });
        }

        return $parameters;
    }

    /**
     * Get parameters for sorters with the given identifier/entity name.
     *
     * @param bool $filter
     * @param string $entity
     */
    public static function getSorterParameters($entity, $filter = false)
    {
        return self::getParameterClass()->getSorterParameters($entity);
    }

}
