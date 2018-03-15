<?php

namespace Listem\Html\Elems;

use Listem\Html\Support\Attribute;

abstract class AbstractElem implements ElemInterface
{
    protected $attributes;

    abstract public function render();

    public function __toString()
    {
        return $this->render();
    }

    public function setAttribute($attribute, $value)
    {
        $this->attributes->setAttribute($attribute, $value);

        return $this;
    }

    public function addClass($class)
    {
        $this->attributes->addClass($class);

        return $this;
    }

    public function removeClass($class)
    {
        $this->attributes->removeClass($class);

        return $this;
    }
}
