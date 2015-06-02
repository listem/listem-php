<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\RadioHtml;

class BooleanEquals extends AbstractFilterOption
{

    protected function initInputs()
    {
        $inputs[] = new RadioHtml($this->entity, $this->filter, $this->parameters, 'True');
        $inputs[] = new RadioHtml($this->entity, $this->filter, $this->parameters, 'False');

        return $inputs;
    }

}
