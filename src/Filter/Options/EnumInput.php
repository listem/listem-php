<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Radio;

class EnumInput extends AbstractOption
{
    protected $enums = array();

    public static $DEFAULT_OPTIONS = array(
        'any' => '',
        1 => 'Active',
        0 => 'Inactive'
    );

    public function getInputs()
    {
        if (empty($this->enums)) {
            if (isset($this->settings['enums']) && !empty($this->settings['enums'])) {
                $this->enums = array('any' => '') + $this->settings['enums'];
            } else {
                $this->enums = self::$DEFAULT_OPTIONS;
            }
        }

        return $this->generateInputs();
    }

    public function setDefault($defaultValue)
    {
        if ($defaultValue === null && isset($this->enums['any'])) {
            $defaultValue = 'any';
        }

        $this->settings['default'] = $defaultValue;
    }

    public function setEnums(array $enums)
    {
        $this->enums = $enums;
    }

    protected function generateInputs()
    {
        $inputs = array();

        foreach ($this->enums as $value => $text) {
            $value = (is_numeric($value)) ? (float) $value : $value;
            $defaultValue = (is_numeric($this->getDefaultValue())) ? (float) $this->getDefaultValue() : $this->getDefaultValue();

            $selected = ($value === $defaultValue);

            $inputs[] = new Radio($this->name, $text, $value, $selected);
        }

        return $inputs;
    }
}
