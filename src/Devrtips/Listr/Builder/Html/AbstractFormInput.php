<?php

namespace Devrtips\Listr\Builder\Html;

abstract class AbstractFormInput implements HtmlInterface, FormInputInterface
{

    /**
     * Generate and return HTML input name from the given entity and filter name(s).
     *
     * @param string $entity
     * @param mixed $filter
     * @return string
     */
    protected function generateName($entity, $filter)
    {
        $name = 'filters[' . $entity . ']';

        $filter = (is_array($filter)) ? $filter : [$filter];

        foreach ($filter as $f) {
            $name .= '[' . $f . ']';
        }

        return $name;
    }

    /**
     * Check if passed parameter matches the input's value attribute.
     * If parameter is numeric, loose check with the value. If parameter is non numeric,
     * strict check with the value. This is due to a null value being identified as 0.
     *
     * @param mixed $value
     * @param string $parameter
     */
    protected function isSelected($value, $parameter)
    {
        return (is_numeric($parameter)) ? ($value == $parameter) : ($value === $parameter);
    }

}
