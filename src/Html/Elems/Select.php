<?php

namespace Listem\Html\Elems;

use Listem\Html\Support\Attribute;

class Select extends AbstractElem
{
    protected $enums = array();
    protected $defaultValue = null;

    public function __construct($name, $enums, $defaultValue = null)
    {
        $this->attributes = new Attribute;
        $this->setAttribute('name', $name);

        $this->defaultValue = $defaultValue;
        $this->enums = $enums;
    }

    public function render()
    {
    	$optionElems = implode("\n", $this->getOptionElems());

        return <<<Html
<select {$this->attributes}>
	{$optionElems}
</select>
Html;
    }

    protected function getOptionElems()
    {
        $optionElems = array();

        foreach ($this->enums as $value => $text) {
            $value = (is_numeric($value)) ? (float) $value : $value;
            $defaultValue = (is_numeric($this->defaultValue)) ? (float) $this->defaultValue : $this->defaultValue;
            $selected = ($value === $defaultValue);

            $optionElems[] = new SelectOption($value, $text, $selected);          
        }

        return $optionElems;
    }

    public function setEnums(array $enums)
    {
        $this->enums = $enums;
    }

    public function getEnums()
    {
        return $this->enums;
    }

    public function setDefault($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        if ($this->defaultValue === null && isset($this->enums['any'])) {
            $this->defaultValue = 'any';
        }
    }
}
