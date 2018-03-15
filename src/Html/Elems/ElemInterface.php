<?php

namespace Listem\Html\Elems;

interface ElemInterface
{
    public function render();
    public function __toString();
    public function setAttribute($attribute, $value);
    public function addClass($class);
    public function removeClass($class);
}