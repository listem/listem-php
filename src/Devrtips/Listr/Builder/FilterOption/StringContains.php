<?php

namespace Devrtips\Listr\Builder\FilterOption;

class StringContains extends AbstractFilterOption
{

    public function render()
    {
        return $this->html->renderInput($this->parameters);
    }

}
