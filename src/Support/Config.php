<?php

namespace Listem\Support;

use Exception;
use Listem\Filter\Filter;

class Config extends Collection
{

    use ArrayAccessItems;

    const DEFAULT_FILTER_OPTION = Filter::STRING;

    protected $items = array();

    public function __construct(array $config)
    {
        foreach ($config['filters'] as $key => &$filter) {
            // filter modify and assign to itself
            $filter = $this->prepareFilters($key, $filter);
        }
        
        $this->items = $config;
    }

    protected function prepareFilters($filterName, array $settings = array())
    {
        // Get table column name(s). Can be a single column (string) or multiple (array).
        $column = (isset($settings['column'])) ? $settings['column'] : $filterName;

        // Populate column(s) as an array to maintain uniformity.
        $columns = (is_array($column)) ? $column : [$column];

        $type = (isset($settings['type'])) ? $settings['type'] : self::DEFAULT_FILTER_OPTION;

        $active = (isset($settings['active'])) ? $settings['active'] : false;

        $default = (isset($settings['default'])) ? $settings['default'] : false;

        $enums = (isset($settings['enums'])) ? $settings['enums'] : array();

        if (!isset($settings['label']) || empty($settings['label'])) {
            throw new Exception("Label needed for filter '{$filterName}'.");
        }

        $placeholder = (isset($settings['placeholder'])) ? $settings['placeholder'] : null;

        return array(
            'name' => $filterName,
            'columns' => $columns,
            'type' => $type,
            'label' => $settings['label'],
            'active' => $active,
            'default' => $default,
            'placeholder' => $placeholder,
            'enums' => $enums,
        );
    }
}
