<?php

namespace Devrtips\Listr\Builder\FilterOption;

use ArrayIterator;
use IteratorAggregate;
use Devrtips\Listr\Config;
use Devrtips\Listr\Parameter;
use Devrtips\Listr\Collection\Collection;
use Devrtips\Listr\Collection\ArrayAccess;

abstract class AbstractFilterOption extends ArrayAccess implements FilterOptionInterface, IteratorAggregate
{

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var string
     */
    protected $filter;

    /**
     * @var bool
     */
    protected $default;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $parameters;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $inputs;

    /**
     * @var array
     */
    protected $config;

    /**
     * Initialize instance and set it's default property.
     *
     * @param bool $default
     * @param string $entity
     * @param string $filter
     */
    public function __construct($default, $entity, $filter)
    {
        $this->default = $default;
        $this->entity = $entity;
        $this->filter = $filter;
        $this->config = Config::get()['filters'][$entity][$filter];

        // Get filter parameters
        $parameters = Parameter::getFilterParameters($entity, $filter);

        if (isset($parameters[$filter])) {
            // If parameters don't indicate which filter option they were passed
            // for (if sent in simple format), consider them as parameters
            // for the default filter option.
            if ($this->default) {
                $this->active = true;
                $this->parameters = $parameters[$filter];
            }
        }

        // After all class attributes are set, initialize inputs.
        $this->inputs = new Collection($this->initInputs());
    }

    public function getQuery()
    {

    }

    public function setParameters()
    {

    }

    public function getParameters()
    {

    }

    /**
     * Returns the rendered HTML inputs of the filter.
     *
     * @return string
     */
    public function render()
    {
        $inputs = [];

        foreach ($this->inputs as $input) {
            $inputs[] = $input->render();
        }

        return implode('', $inputs);
    }

    abstract protected function initInputs();

    /**
     * Implementation of Traversable interface.
     * Once collection object is inside foreach, protected property $inputs will be iterated.
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->inputs->toArray());
    }

}