<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Textbox;

class DateBetween extends AbstractFilterOption
{

    protected function initInputs()
    {
        $inputs[] = new Textbox('text', $this->entity, $this->filter, $this->parameters);
        $inputs[] = new Textbox('text', $this->entity, $this->filter, $this->parameters);

        return $inputs;
    }

}
