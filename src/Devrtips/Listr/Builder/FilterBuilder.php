<?php

namespace Devrtips\Listr\Builder;

use Devrtips\Listr\Builder\Html\Label;
use Devrtips\Listr\Collection\ArrayAccess;

class FilterBuilder extends ArrayAccess
{

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var array
     */
    protected $columns = array();

    /**
     * @var string
     */
    protected $type = 'string';

    /**
     * @var Devrtips\Listr\Builder\Html\Label
     */
    protected $label;

    /**
     * @var string
     */
    protected $placeholder;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $options;

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
        $this->label = new Label($label, $this->entity, $this->identifier);

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
     * Return the label of the filter.
     *
     * @return Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Return the default option of the filter.
     *
     * @return Devrtips\Listr\Builder\FilterOption\FilterOptionInterface
     */
    public function getDefaultOption()
    {
        return $this->options->where('default', 1)->first();
    }

    /**
     * Return options collection of the filter.
     *
     * @return Devrtips\Listr\Collection\Collection
     */
    public function getOptions()
    {
        return $this->options;
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
