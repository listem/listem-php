<?php

namespace Devrtips\Listr\Builder;

use ArrayAccess;
use Devrtips\Listr\Collection\Collection;

class Filter implements ArrayAccess
{

    /**
     * @var string
     */
    public $entity;

    /**
     * @var string
     */
    public $identifier;

    /**
     * @var array
     */
    public $columns = array();

    /**
     * @var string
     */
    public $type = 'string';

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    public $options;

    public function __construct()
    {

    }

    /**
     * Set filters options based on the type of the filter.
     *
     * @return void
     */
    public function setOptions()
    {
        // Get options according to the given filter type.
        $options = FilterOption::getOptions($this->type, $this->entity, $this->identifier);

        $this->options = $options;
    }

    /**
     * ArrayAccess implementation.
     * Setting a property is prohibited.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {

    }

    /**
     * ArrayAccess implementation.
     * Checking whether a property exists, is allowed.
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * ArrayAccess implementation.
     * Unsetting a property is prohibited.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {

    }

    /**
     * ArrayAccess implementation.
     * Retrieving a property is allowed.
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

}
