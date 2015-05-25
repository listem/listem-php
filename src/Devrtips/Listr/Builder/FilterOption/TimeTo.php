<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\TextboxHtml;

class TimeTo extends AbstractFilterOption
{

    protected function initInputs()
    {
        $input = new TextboxHtml('text', $this->entity, $this->filter, $this->parameters);

        return [$input];
    }

}
