<?php

namespace Devrtips\Listr\Builder\Html;

class LabelHtml implements HtmlInterface
{

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $name;

    public function __construct($text, $entity, $filter)
    {
        $this->text = $text;
        $this->name = 'filters[' . $entity . '][' . $filter . ']';
    }

    public function render()
    {
        return '<label for="' . $this->name . '">' . $this->text . '</label>';
    }

}
