<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\RadioHtml;

class BooleanEquals extends AbstractFilterOption
{

    protected function initInputs()
    {
        $inputs[] = new RadioHtml('text', $this->entity, $this->filter, $this->parameters);
        $inputs[] = new RadioHtml('text', $this->entity, $this->filter, $this->parameters);

        return $inputs;
    }

}
