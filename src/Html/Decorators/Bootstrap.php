<?php

namespace Listem\Html\Decorators;

use Listem\Html\Elems;
use Listem\Filter\Options;

class Bootstrap
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;

        $this->filter->getLabel()
                ->addClass('control-label')
                ->addClass('col-sm-3');

        $this->filter->getFormElem()->addRenderCallback(function ($input, $option) {

            switch (get_class($input)) {
                case Elems\Textbox::class:
                case Elems\Select::class:
                    $input->addClass('form-control');
                    break;

                case Elems\Checkbox::class:
                    $input->label->addClass('checkbox-inline');
                    break;

                case Elems\Radio::class:
                    $input->label->addClass('radio-inline');
                    $input->label->addClass('col-sm-4');
                    break;
            }

            // Date inputs should be displayed inline
            if (get_class($option) === Options\DateBetween::class) {
                $input->addClass('col-md-6');
            }
        });
    }

    public function renderLabel()
    {
        return $this->filter->renderLabel();
    }

    public function renderFormElem()
    {
        return '<div class="col-sm-9 input-group">' . $this->filter->renderFormElem() . '</div>';
    }
}
