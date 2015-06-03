<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Textbox;

class DateBetween extends AbstractFilterOption
{

    protected $inputs = array('from', 'to');

    protected function initInputs()
    {
        foreach ($this->inputs as $input) {
            $inputs[] = new Textbox('text', $this->entity, [$this->filter, $input], $this->parameters[$input]);
        }

        return $inputs;
    }

}
