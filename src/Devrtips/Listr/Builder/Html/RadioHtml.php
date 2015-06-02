<?php

namespace Devrtips\Listr\Builder\Html;

class RadioHtml implements HtmlInterface, HtmlInputInterface
{

    protected $type = 'radio';
    protected $name;
    protected $value;
    protected $label;

    public function __construct($entity, $filter, $value, $label)
    {
        $this->name = 'filters[' . $entity . '][' . $filter . ']';
        $this->value = $value;
        $this->label = $label;
    }

    public function render()
    {
        return '<label><input type="radio" name="' . $this->name . '" value="' . $this->value . '" /> ' . $this->label . '</label>';
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
