<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Radio;

class BooleanEquals extends AbstractFilterOption
{

    protected function initInputs()
    {
        $inputs[] = new Radio($this->entity, $this->filter, 1, $this->parameters, 'True');
        $inputs[] = new Radio($this->entity, $this->filter, 0, $this->parameters, 'False');

        return $inputs;
    }

}
