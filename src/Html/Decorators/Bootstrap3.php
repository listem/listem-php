<?php

namespace Devrtips\Listr\Html\Decorators;

use Devrtips\Listr\Html\Elems\Label as Div;

class Bootstrap3
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;

        $this->filter->getLabel()
                ->addClass('control-label')
                ->addClass('col-sm-4');
                
        $this->filter->getFormElem()->addRenderCallback(function ($input) {
            switch (get_class($input)) {
                case 'Devrtips\Listr\Html\Elems\Textbox':
                case 'Devrtips\Listr\Html\Elems\Select':
                    $input->addClass('form-control');
                    break;

                case 'Devrtips\Listr\Html\Elems\Checkbox':
                    $input->label->addClass('checkbox-inline');
                    break;

                case 'Devrtips\Listr\Html\Elems\Radio':
                    $input->label->addClass('radio-inline');
                    break;
            }
        });
    }

    public function renderLabel()
    {
        return $this->filter->renderLabel();
    }

    public function renderFormElem()
    {
        return '<div class="col-sm-8">' . $this->filter->renderFormElem() . '</div>';
    }
}
