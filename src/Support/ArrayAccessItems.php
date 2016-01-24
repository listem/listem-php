<?php

namespace Devrtips\Listr\Support;

trait ArrayAccessItems
{
    use ArrayAccess;

    /**
     * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

}
