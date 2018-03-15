<?php

namespace Listem\Html\Elems;

use Listem\Html\Support\Attribute;

class Radio extends AbstractElem
{

    protected $value = null;

    public function __construct($name, $text, $value, $checked = false)
    {

        $this->value = $value;
        $this->attributes = new Attribute;
        $this->label = new Label($text);
        $this->setAttribute('value', $value);
        $this->setAttribute('type', 'radio');
        $this->setAttribute('name', $name);
        $this->setAttribute('checked', ($checked) ? 'checked' : null);            
    }

    public function render()
    {
		$optionHtml = <<<Html
<input {$this->attributes}/>
Html;

        // Place input inside the label
		$this->label->prependText($optionHtml);

        return $this->label->render();
    }

    public function getValue()
    {
        return $this->value;
    }
}
