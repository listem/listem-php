<?php

namespace Listem\Filter\Options;

use ReflectionClass;
use ArrayAccess as PHPArrayAccess;
use Listem\Support\ArrayAccess;

abstract class AbstractOption implements PHPArrayAccess, OptionInterface
{
    use ArrayAccess;

    protected $name = false;
    protected $active = false;
    protected $settings;
    protected $parameters;
    protected $renderCallbacks = array();

    public function __construct($name, $active, $settings, $parameters)
    {
        $this->name = $name;
        $this->active = $active;
        $this->settings = $settings;
        $this->parameters = $parameters;
    }

    public function render()
    {
        $output = '';

        // Concat all inputs belonging to this filter option
        foreach ($this->getInputs() as $input) {
            foreach ($this->renderCallbacks as $callback) {
                $callback($input);
            }

            $output .= $input->render();
        }

        return $output;
    }

    public function addRenderCallback($callback)
    {
        $this->renderCallbacks[] = $callback;
    }

    public function getParams()
    {

    }

    public function getDefaultValue($column_suffix = '')
    {
        $param = $this->parameters->getFilterParam($this->name . $column_suffix);

        $defaultValue = (!is_null($param))
            ? $param 
            : $this->settings['default'];

        return (is_numeric($defaultValue)) ? (float) $defaultValue : $defaultValue;
    }

    public function getConditions()
    {
        $value = $this->getDefaultValue();

        if ($value === null || $value === '' || $value === false  || $value === 'any') {
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
