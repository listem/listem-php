<?php

namespace Devrtips\Listr\Filter\Options;

use Devrtips\Listr\Html\Elems\Select;

class EnumSelect extends AbstractOption
{
    protected static $DEFAULT_OPTIONS = array(
        'any' => '', 
        1 => 'Active', 
        0 => 'Inactive'
    );

   	protected function boot()
    {
        $options = (isset($this->settings['enums']) && !empty($this->settings['enums'])) ? array('any' => '') + $this->settings['enums'] : self::$DEFAULT_OPTIONS;

        $this->inputs[] = new Select($this->name, $options, $this->getDefaultValue());
    }
}
