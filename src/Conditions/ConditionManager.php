<?php

namespace Listem\Conditions;

use Listem\Filter\Filter;
use Listem\Conditions\Database\Drivers\My;

class ConditionManager
{

    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function formatConditions(array $conditions)
    {
        $formatted = array();

        foreach (array_filter($conditions) as $options) {
            foreach (array_filter($options) as $condition) {
                switch ($condition['type']) {
                    case Filter::STRING_CONTAINS:
                        $formatted[] = $this->driver->getStringContainsCondition($condition);
                        break;
                    case Filter::STRING_BEGINS_WITH:
                        $formatted[] = $this->driver->getStringBeginsWithCondition($condition);
                        break;
                    case Filter::STRING_ENDS_WITH:
                        $formatted[] = $this->driver->getStringEndsWithCondition($condition);
                        break;
                    case Filter::DATE_BETWEEN:
                        $formatted[] = $this->driver->getDateBetweenCondition($condition);
                        break;
                    case Filter::DATE_BEFORE:
                        $formatted[] = $this->driver->getDateBeforeCondition($condition);
                        break;
                    case Filter::DATE_AFTER:
                        $formatted[] = $this->driver->getDateAfterCondition($condition);
                        break;
                    case Filter::STRING_EQUALS:
                    case Filter::ENUM_SELECT:
                    case Filter::ENUM_INPUT:
                        $formatted[] = $this->driver->getEnumInputsCondition($condition);
                        break;
                }
            }
        }

        return implode(' AND ', $formatted);
    }

    // public static function getConditionString($condition, $conditionString)
    // {
    //     $innerConditions = [];
        
    //     foreach ($condition['cols'] as $col) {
    //         $replace = array(':column' => $col);
            
    //         if (is_array($condition['value'])) {
    //             foreach ($condition['value'] as $suffix => $value) {
    //                 $replace[':value_' . $suffix] = $value;
    //             }
    //         } else {
    //             $replace[':value'] = $condition['value'];
    //         }

    //         $innerConditions[] = strtr($conditionString, $replace);
    //     }

    //     return '(' . implode(' OR ', $innerConditions) . ')';
    // }
}
