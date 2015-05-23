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
     * @param string $entity
     */
    public static function getFilterParameters($entity)
    {
        return self::getParameterClass()->getFilterParameters($entity);
    }

    /**
     * Get parameters for sorters with the given identifier/entity name.
     *
     * @param string $entity
     */
    public static function getSorterParameters($entity)
    {
        return self::getParameterClass()->getSorterParameters($entity);
    }

}
