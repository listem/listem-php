<?php

namespace Devrtips\Listr\Builder\Html;

class Textbox implements HtmlInterface, FormInputInterface
{

    protected $type;
    protected $name;
    protected $value;

    public function __construct($type, $entity, $filter, $value)
    {
        $this->type = $type;
        $this->name = 'filters[' . $entity . '][' . $filter . ']';
        $this->value = $value;
    }

    public function render()
    {
        return '<input type="text" name="' . $this->name . '" id="' . $this->name . '" value="' . $this->value . '" />';
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

}
