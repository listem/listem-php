<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Radio;

class EnumInput extends AbstractOption
{
    protected $enums = array();

    protected static $DEFAULT_OPTIONS = array(
        'any' => 'Any', 
        1 => 'Active', 
        0 => 'Inactive'
    );

   	protected function boot()
    {
        $this->enums = self::$DEFAULT_OPTIONS;

        if (isset($this->settings['enums']) && !empty($this->settings['enums'])) {
            $this->enums = array('any' => '') + $this->settings['enums'];
        }
        
        $this->generateInputs();
    }

    public function setDefault($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        
        if ($this->defaultValue === null && isset($this->enums['any'])) {
            $this->defaultValue = 'any';
        }

        $this->generateInputs();
    }

    public function setEnums(array $enums)
    {
        $this->enums = $enums;
    }

    protected function generateInputs()
    {
        $this->inputs = array();

        foreach ($this->enums as $value => $text) {
            $value = (is_numeric($value)) ? (float) $value : $value;
            $defaultValue = (is_numeric($this->defaultValue)) ? (float) $this->defaultValue : $this->defaultValue;

            $selected = ($value === $defaultValue);

            $this->inputs[] = new Radio($this->name, $text, $value, $selected);
        }
    }
}
