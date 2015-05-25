<?php

namespace Devrtips\Listr\Builder\Html;

class RadioHtml implements HtmlInterface, HtmlInputInterface
{

    protected $type = 'radio';
    protected $name;
    protected $value;

    public function __construct($entity, $filter, $value)
    {
        $this->name = 'filters[' . $entity . '][' . $filter . ']';
        $this->value = $value;
    }

    public function render()
    {
        return '<input type="radio" name="' . $this->name . '" id="' . $this->name . '" value="' . $this->value . '" />';
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
