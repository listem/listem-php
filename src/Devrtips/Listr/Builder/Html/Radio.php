<?php

namespace Devrtips\Listr\Builder\Html;

class Radio extends AbstractFormInput
{

    protected $type = 'radio';
    protected $name;
    protected $value;
    protected $selected;
    protected $label;

    public function __construct($entity, $filter, $value, $parameter, $label)
    {
        $this->name = 'filters[' . $entity . '][' . $filter . ']';
        $this->value = $value;
        $this->selected = $this->isSelected($value, $parameter);
        $this->label = $label;
    }

    public function render()
    {
        return '<label><input type="radio" name="' . $this->name . '" value="' . $this->value . '" ' . ($this->selected ? 'checked' : '') . ' /> ' . $this->label . '</label>';
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
