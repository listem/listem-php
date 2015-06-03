<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Radio;

class RadioEquals extends AbstractFilterOption
{

    protected function initInputs()
    {

        if(!isset($this->config['options'])){
            throw new Exception('Please specify options in your config file for ' . $this->entity . '[' . $this->filter . ']');
        }

        $options = $this->config['options'];

        foreach ($options as $value => $label) {
            $inputs[] = new Radio($this->entity, $this->filter, $value, $this->parameters, $label);
        }

        return $inputs;
    }

}
