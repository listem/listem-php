<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\TextboxHtml;

class TimeBetween extends AbstractFilterOption
{

    protected function initInputs()
    {
        $inputs[] = new TextboxHtml('text', $this->entity, $this->filter, $this->parameters);
        $inputs[] = new TextboxHtml('text', $this->entity, $this->filter, $this->parameters);

        return $inputs;
    }

}
