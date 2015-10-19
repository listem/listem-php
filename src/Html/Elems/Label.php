<?php

namespace Devrtips\Listr\Html\Elems;

use Devrtips\Listr\Html\Support\Attribute;

class Label extends AbstractElem
{
    public function __construct($text = '')
    {
        $this->attributes = new Attribute;
        $this->text = $text;
    }

    public function render()
    {
        return <<<Html
<label {$this->attributes}>{$this->text}</label>\n
Html;
    }

    public function appendText($text)
    {
        $this->text = $this->text . $text;

        return $this;
    }

    public function prependText($text)
    {
        $this->text = $text . ' ' . $this->text;

        return $this;
    }
}
