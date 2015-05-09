<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Parameter;

class AbstractOption implements FilterOptionInterface
{

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
     * Initialize instance and set it's default property.
     *
     * @param bool $default
     * @param string $entity
     * @param string $filter
     */
    public function __construct($default, $entity, $filter)
    {
        $this->default = $default;

        // Get parameters
        $parameters = Parameter::getFilterParameters($entity, $filter);

        if(isset($parameters[$filter])){
            $this->active = true;
            $this->parameters = $parameters[$filter];
        }
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

}
