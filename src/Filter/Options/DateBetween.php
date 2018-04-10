<?php

namespace Listem\Filter\Options;

use Listem\Filter\Filter;
use Listem\Html\Elems\Textbox;

class DateBetween extends AbstractOption
{   
    public function getInputs()
    {
        $inputs = array();
        $placeholderValues = $this->settings['placeholder'];
     
        $inputs[] = new Textbox($this->name . '_from', $this->getDefaultValue('_from'), $placeholderValues['from']);
        $inputs[] = new Textbox($this->name . '_to', $this->getDefaultValue('_to'), $placeholderValues['to']);

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
