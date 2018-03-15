<?php

namespace Listem\Html\Decorators;

use Listem\Html\Elems\Label as Div;

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
                case 'Listem\Html\Elems\Textbox':
                case 'Listem\Html\Elems\Select':
                    $input->addClass('form-control');
                    break;

                case 'Listem\Html\Elems\Checkbox':
                    $input->label->addClass('checkbox-inline');
                    break;

                case 'Listem\Html\Elems\Radio':
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
