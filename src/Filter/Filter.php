<?php

namespace Devrtips\Listr\Filter;

use Exception;
use ReflectionClass;
use Devrtips\Listr\Filter\Option;
use Devrtips\Listr\Html\Elems\Label;
use Devrtips\Listr\Support\Collection;
use Devrtips\Listr\Parameter\ParameterInterface;

class Filter extends Collection
{

    const STRING = 'String';
    const STRING_CONTAINS = 'StringContains';
    const STRING_EQUALS = 'StringEquals';
    const STRING_BEGINS_WITH = 'StringBeginsWith';
    const STRING_ENDS_WITH = 'StringEndsWith';

    const DATE = 'Date';
    const DATE_BETWEEN = 'DateBetween';
    const DATE_BEFORE = 'DateBefore';
    const DATE_AFTER = 'DateAfter';

    const ENUM = 'Enum';
    const ENUM_SELECT = 'EnumSelect';
    const ENUM_INPUT = 'EnumInput';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Html\Elems\Label
     */
    protected $label;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $config;

    /**
     * @var Devrtips\Listr\Collection\Collection
     */
    protected $options;

    public function __construct($name, array $settings, ParameterInterface $parameters)
    {
        $this->name = $name;
        $this->options = $this->buildFilterOptions($settings, $parameters);
        $this->label = new Label($settings['label']);
    }

    /**
     * Returns the default option for this filter
     *
     * @return Html\Elems\Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Returns the default option for this filter
     *
     * @return Devrtips\Listr\Filter\Options\OptionInterface
     */
    public function getFormElem()
    {
        if (count($default = $this->options->where('default', true))) {
            return $default->first();
        }

        return $this->options->first();
    }

    /**
     *
     *
     * @return string
     */
    public function renderLabel()
    {
        return $this->getLabel()->render();
    }

    /**
     *
     * @return string
     */
    public function renderFormElem()
    {
        return $this->getFormElem()->render();
    }

    /**
     * Returns the options available for this filter
     *
     * @return Filter\Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setEnums(array $enums, $blankOption = true)
    {
        if ($blankOption) {
            $blankOptionText = ($blankOption === true) ? '' : $blankOption;
            $enums = array('any' => $blankOptionText) + $enums;
        }

        foreach ($this->options as $option) {
            // Todo: check if option implements Devrtips\Listr\Filter\Options\EnumInterface
            switch (get_class($option)) {
                case 'Devrtips\Listr\Filter\Options\EnumSelect':
                case 'Devrtips\Listr\Filter\Options\EnumInput':
                    $option->setEnums($enums);
                    break;
                default:
                    throw new Exception('Dynamically enums values can be set for enum types only.');
            }
        }

        return $this;
    }
    
    public function setDefault($defaultValue)
    {
        foreach ($this->options as $option) {
            // Todo: check if option implements Devrtips\Listr\Filter\Options\EnumInterface
            switch (get_class($option)) {
                case 'Devrtips\Listr\Filter\Options\EnumSelect':
                case 'Devrtips\Listr\Filter\Options\EnumInput':
                    $option->setDefault($defaultValue);
                    break;
                default:
                    throw new Exception('Default values can be set for enum types only.');
            }
            
        }

        return $this;
    }

    protected function buildFilterOptions($settings, $parameters)
    {
        $options = array();

        switch ($settings['type']) {
            case self::STRING:
                // Specify the default option type for this category (self::STRING) of options
                $defaultOption = self::STRING_CONTAINS;
                $options[] = $this->buildOption(self::STRING_CONTAINS, $defaultOption, $settings, $parameters);
                $options[] = $this->buildOption(self::STRING_EQUALS, $defaultOption, $settings, $parameters);
                $options[] = $this->buildOption(self::STRING_EQUALS, $defaultOption, $settings, $parameters);
                break;

            case self::DATE:
                $defaultOption = self::DATE_BETWEEN;
                $options[] = $this->buildOption(self::DATE_BETWEEN, $defaultOption, $settings, $parameters);
                break;

            case self::ENUM:
                $defaultOption = self::ENUM_SELECT;
                $options[] = $this->buildOption(self::ENUM_SELECT, $defaultOption, $settings, $parameters);
                break;
                
            default:
                $options[] = $this->buildOption($settings['type'], $settings['type'], $settings, $parameters);
                break;
        }

        return new Collection($options);
    }

    protected function buildOption($type, $defaultOption, $settings, $parameters)
    {
        // Todo: Throw exception if filter not found
        $class = "Devrtips\Listr\Filter\Options\\" . $type;
        $active = ($type == $defaultOption);
        $name = $settings['name'];

        return new $class($name, $active, $settings, $parameters);
    }

    public function getConditions()
    {
        $conditions = [];

        foreach ($this->options->where('active', 1) as $option) {
            $conditions[] = $option->getConditions();
        }

        return $conditions;
    }
}
