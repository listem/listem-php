<?php

namespace Devrtips\Listr\Builder\FilterOption;

class DateBetween extends AbstractFilterOption
{

    public function render()
    {
        return $this->html->renderInput($this->parameters);
    }
}
