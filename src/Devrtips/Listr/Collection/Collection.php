<?php

namespace Devrtips\Listr\Collection;

use ArrayIterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{

    /**
     * @var array
     */
    protected $items = array();

    /**
     * Intialize class by populating the items array,
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Filter items from the given key value pair.
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function where($key, $value)
    {
        $this->items = array_filter($this->items, function($item) use ($key, $value) {
            return isset($item[$key]) && $item[$key] == $value;
        });

        return $this;
    }

    /**
     * Return the number of items in the list.
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Implementation of Traversable interface.
     * Once collection object is inside foreach, protected property $items will be iterated.
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

}
