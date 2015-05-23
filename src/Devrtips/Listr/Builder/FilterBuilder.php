<?php

namespace Devrtips\Listr\Builder;

use Devrtips\Listr\Builder\Html\LabelHtml;
use Devrtips\Listr\Collection\ArrayAccess;

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
     * @var Devrtips\Listr\Builder\Html\LabelHtml
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

    /**
     * If an array is passed, populate the existing properties of the instance with them.
     *
     * @param string $entity
     * @param string $identifier
     * @param array $columns
     * @param string $type
     * @param string $label
     * @param string $placeholder
     */
    public function __construct($entity, $identifier, array $columns, $type, $label, $placeholder = '')
    {
        $this->entity = $entity;
        $this->identifier = $identifier;
        $this->columns = $columns;
        $this->type = $type;
        $this->placeholder = ($placeholder) ? $placeholder : $label;

        // Set label property for the filter.
        $this->label = new LabelHtml($label, $this->entity, $this->identifier);

        // Set filter options. This assumes that the entity and other required
        // properties were populated initially in the constructor.
        $this->initOptions();
    }

    /**
     * Set filters options based on the type of the filter.
     *
     * @return void
     */
    protected function initOptions()
    {
        // Get options according to the given filter type.
        $options = FilterOptionBuilder::getOptions($this->type, $this->entity, $this->identifier);

        $this->options = $options;
    }

    /**
     * Returns the rendered HTML output of a filter label.
     *
     * @return string
     */
    public function renderLabel()
    {
        return $this->label->render();
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
