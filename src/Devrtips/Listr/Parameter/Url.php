<?php

namespace Devrtips\Listr\Parameter;

class Url implements ParameterInterface
{

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @var array
     */
    protected $sorters = array();

    /**
     * Populate filters and sorters attributes with matching GET parameters.
     *
     * @return void
     */
    public function __construct()
    {
        $this->filters = isset($_GET['filters']) ? $_GET['filters'] : [];
        $this->sorters = isset($_GET['sorters']) ? $_GET['sorters'] : [];
    }

    /**
     * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    public function getFilterParameters($entity)
    {
        return (isset($this->filters[$entity])) ? $this->filters[$entity] : [];
    }

    /**
     * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    public function getSorterParameters($entity)
    {
        return (isset($this->sorters[$entity])) ? $this->filters[$entity] : [];
    }

}
