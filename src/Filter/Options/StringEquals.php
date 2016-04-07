<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Textbox;

class StringEquals extends AbstractOption
{
    public function getInputs()
    {
        return [new Textbox($this->name, $this->getDefaultValue())];
    }
}
