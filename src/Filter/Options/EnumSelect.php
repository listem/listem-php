<?php

namespace Listem\Filter\Options;

use Listem\Html\Elems\Select;

class EnumSelect extends AbstractOption
{
    protected $enums = array();

    protected static $DEFAULT_OPTIONS = array(
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

        return [new Select($this->name, $this->enums, $this->getDefaultValue())];
    }

    public function setEnums(array $enums)
    {
        $this->enums = $enums;
    }

    public function setDefault($defaultValue)
    {
        if ($defaultValue === null && isset($this->enums['any'])) {
            $defaultValue = 'any';
        }

        $this->settings['default'] = $defaultValue;
    }
}
