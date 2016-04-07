<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Filter\Filter;
use Devrtips\Listr\Html\Elems\Textbox;

class DateBetween extends AbstractOption
{   
    public function getInputs()
    {
        $inputs = array();

        $inputs[] = new Textbox($this->name . '_from', $this->getDefaultValue('_from'));
        $inputs[] = new Textbox($this->name . '_to', $this->getDefaultValue('_to'));

        return $inputs;
    }

    public function getConditions()
    {
        $fromValue = $this->getDefaultValue('_from');
        $toValue = $this->getDefaultValue('_to');

        if ($fromValue == null && $toValue == null) {
            return null;
        }

        $values = ['from' => $fromValue, 'to' => $toValue];
        $type = $this->getType();

        if ($fromValue == null) {
            $values = $toValue;
            $type = Filter::DATE_BEFORE;
        } else if ($toValue == null) {
            $values = $fromValue;
            $type = Filter::DATE_AFTER;
        }

        return [
            'cols' => $this->settings['columns'],
            'value' => $values,
            'type' => $type
        ];
    }
}
