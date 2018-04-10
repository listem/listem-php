<?php

namespace Listem\Html\Elems;

use Listem\Html\Support\Attribute;

class SelectOption extends AbstractElem
{
    public function __construct($value, $text, $selected = false)
    {
        $this->attributes = new Attribute;
        $this->text = $text;
        $this->setAttribute('value', $value);
        $this->setAttribute('selected', ($selected) ? 'selected' : null);            
    }

    public function render()
    {
        return <<<Html
<option {$this->attributes}>{$this->text}</option>
Html;
    }
}
