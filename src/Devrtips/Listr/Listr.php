<?php

namespace Devrtips\Listr;

class Listr
{

    /**
     * @var Devrtips\Listr\Filter
     */
    public $filters;

    /**
     * @var Devrtips\Listr\Sorter
     */
    public $sorters;

    /**
     * Contains the configurations for filters and sorters.
     *
     * @var array
     */
    protected $config;

    /**
     * Initialize the class by populating the config array.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = Config::set($config);
    }

    /**
     * Initialize filters and sorters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\Listr
     */
    public function initFiltersAndSorters($entity)
    {
        $this->filters = $this->setFilters($entity);

        return $this;
    }

    /**
     * Initialize filters for the given entity.
     *
     * @param string $entity
     * @return \Devrtips\Listr\FiltersList
     */
    public function setFilters($entity)
    {
        $this->filters = new Filter($this->config['filters'], $entity);

        return $this->filters;
    }

    /**
     * Get other (non listr) query string parameters to be set as hidden inputs
     * inside the form to be passed in to the next request when form is submitted.
     *
     * @return string
     */
    public function queryStringParams($innerParam = array())
    {

        $params = [];

        // If method is being reccursed, child params will be passed as the method argument.
        if (!empty($innerParam)) {
            $params = $innerParam;
        } else {
            // Or otherwise, use URL query parameters.
            $params = $_GET;
            unset($params['filters']);
        }

        $inputs = array();

        foreach ($params as $name => $value) {

            // If child parameters are available, prepare them and pass it
            // to this method again to create a flat array of parameters.
            if (is_array($value)) {

                $childParams = [];

                foreach ($value as $innerName => $innerValue) {
                    $childParams[$name . '[' . $innerName . ']'] = $innerValue;
                }

                // The method will return an array of inputs, if an array is passed to the method
                // as an argument. Returned inputs array then is merged to the current inputs array.
                $inputs = array_merge($inputs, $this->queryStringParams($childParams));
                continue;
            }

            $inputs[] = '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
        }

        // If method is being reccursed, return the array of inputs.
        // Otherwise, join the array of inputs in to a sigle string ready to be echoed.
        return (!empty($innerParam)) ? $inputs : implode("\n", $inputs);
    }

}
