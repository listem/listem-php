<?php

namespace Devrtips\Listr\Filter\Options;

use ReflectionClass;
use ArrayAccess as PHPArrayAccess;
use Devrtips\Listr\Support\ArrayAccess;

abstract class AbstractOption implements PHPArrayAccess
{
    use ArrayAccess;

    protected $name = false;
    protected $active = false;
    protected $settings;
    protected $parameters;
    
    protected $inputs = array();

    public function __construct($name, $active = false, $settings, $parameters)
    {
        $this->name = $name;
        $this->active = $active;
        $this->settings = $settings;
        $this->parameters = $parameters;

        $this->boot();
    }

    abstract protected function boot();

    public function render()
    {
        $output = '';

        // Concat all inputs belonging to this filter option
        foreach ($this->inputs as $input) {
            $output .= $input->render();
        }

        return $output;
    }

    public function getParams()
    {

    }

    public function getDefaultValue($column_suffix = '')
    {
        $defaultValue = (!is_null($param = $this->parameters->getFilterParam($this->name . $column_suffix))) ? $param : $this->settings['default'];

        return (is_numeric($defaultValue)) ? (float) $defaultValue : $defaultValue;
    }

    public function getConditions()
    {
        $value = $this->getDefaultValue();

        if ($value == null || $value == 'any') {
            return null;
        }

        return [
            'cols' => $this->settings['columns'],
            'value' => $value,
            'type' => $this->getType()
        ];
    }

    protected function getType()
    {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }
}