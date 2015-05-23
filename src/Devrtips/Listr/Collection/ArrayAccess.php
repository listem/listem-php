<?php

namespace Devrtips\Listr\Collection;

use ArrayAccess as PHPArrayAccess;

class ArrayAccess implements PHPArrayAccess
{

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
