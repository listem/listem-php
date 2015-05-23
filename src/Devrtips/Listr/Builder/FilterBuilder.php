<?php

namespace Devrtips\Listr\Builder;

use Devrtips\Listr\Collection\ArrayAccess;
use Devrtips\Listr\Builder\Html\Filter as FilterHtmlBuilder;

class FilterBuilder extends ArrayAccess
{

    /**
     * @var string
     */
    public $entity;

    /**
     * @var string
     */
    public $identifier;

    /**
     * @var array
     */
    public $columns = array();

    /**
     * @var string
     */
    public $type = 'string';

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    public $options;

    public function __construct()
    {

    }

    /**
     * Set filters options based on the type of the filter.
     *
     * @return void
     */
    public function setOptions()
    {
        // Get options according to the given filter type.
        $options = FilterOptionBuilder::getOptions($this->type, $this->entity, $this->identifier);

        $this->options = $options;
    }

    public function renderLabel()
    {
        // Render the label from filter options. Every option belonging to a filter
        // will return the same label. Here we have used the first option.
        return $this->options->first()
                ->renderLabel($this->label);
    }

    /**
     * Render HTML input of the filter. Usually a filter contains multiple options.
     * By using this method, the input of the first option or the default option
     * is rendered.
     *
     * @return string HTML
     */
    public function renderInput()
    {
        $option = $this->options->where('default', 1)->first();

        return $option->render();
    }
}
