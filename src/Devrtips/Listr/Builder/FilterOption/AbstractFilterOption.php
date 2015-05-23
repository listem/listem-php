<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Parameter;
use Devrtips\Listr\Collection\ArrayAccess;
use Devrtips\Listr\Builder\Html\Filter as FilterHTMLBuilder;

class AbstractFilterOption extends ArrayAccess implements FilterOptionInterface
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
     * @var Devrtips\Listr\Builder\Html\Filter
     */
    protected $html;

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

        $this->html = new FilterHTMLBuilder($this->entity, $this->filter);

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
    }

    public function renderLabel($text){
        return $this->html->renderLabel($text);

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
