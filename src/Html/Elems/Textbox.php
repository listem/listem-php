<?php

namespace Listem\Html\Elems;

use Listem\Html\Support\Attribute;

class Textbox extends AbstractElem
{
    public function __construct($name, $value = null)
    {
        $this->attributes = new Attribute;
        $this->setAttribute('type', 'text');
        $this->setAttribute('name', $name);
        $this->setAttribute('value', $value);
    }

    public function render()
    {
        return <<<Html
<input {$this->attributes}/>\n
Html;
    }
}
