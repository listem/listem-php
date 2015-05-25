<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\TextboxHtml;

class DateTo extends AbstractFilterOption
{

    protected function initInputs()
    {
        $input = new TextboxHtml('text', $this->entity, $this->filter, $this->parameters);

        return [$input];
    }

}
