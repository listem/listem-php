<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Textbox;

class StringContains extends AbstractOption
{   
    protected function boot()
    {
        $this->inputs[] = new Textbox($this->name, $this->getDefaultValue());
    }
}
