<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Textbox;

class StringContains extends AbstractOption
{   
    public function getInputs()
    {
        return [new Textbox($this->name, $this->getDefaultValue())];
    }
}
