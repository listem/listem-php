<?php

namespace Devrtips\Listr\Builder\Html;

class Filter
{

    protected $name;

    public function __construct($entity, $filter)
    {
        $this->name = "filters[{$entity}][{$filter}]";
    }

    public function renderLabel($text)
    {
        return '<label for="' . $this->name . '">' . $text . '</label>';
    }

    public function renderInput($value = '', $options = [])
    {
        return '<input type="text" name="' . $this->name . '" id="' . $this->name . '" value="' . $value . '" />';
    }

    public function renderOptionsList()
    {

    }

    public function renderOption()
    {

    }

}
