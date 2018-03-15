<?php

namespace Listem\Filter\Options;

use Listem\Html\Elems\Textbox;

class StringEquals extends AbstractOption
{
    public function getInputs()
    {
        return [new Textbox($this->name, $this->getDefaultValue())];
    }
}
