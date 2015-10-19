<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Textbox;

class DateBetween extends AbstractOption
{   
    protected function boot()
    {
        $this->inputs[] = new Textbox($this->name . '_from', $this->getDefaultValue($this->name . '_from'));
        $this->inputs[] = new Textbox($this->name . '_to', $this->getDefaultValue($this->name . '_to'));
    }
}
