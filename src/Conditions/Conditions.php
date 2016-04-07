<?php

namespace Devrtips\Listr\Conditions;

use Devrtips\Listr\Filter\Filter;

class Conditions
{

    public static function formatConditions(array $conditions)
    {
        $formatted = array();

        foreach (array_filter($conditions) as $options) {
            foreach (array_filter($options) as $condition) {

                switch ($condition['type']) {
                    case Filter::STRING_CONTAINS:
                        $formatted[] = self::getConditionString($condition, "`:column` LIKE '%:value%'");
                        break;
                    case Filter::STRING_BEGINS_WITH:
                        $formatted[] = self::getConditionString($condition, "`:column` LIKE ':value%'");
                        break;
                    case Filter::STRING_ENDS_WITH:
                        $formatted[] = self::getConditionString($condition, "`:column` LIKE '%:value'");
                        break;
                    case Filter::DATE_BETWEEN:
                        $formatted[] = self::getConditionString($condition, "`:column` >= ':value_from' AND `:column` <= ':value_to'");
                        break;
                    case Filter::DATE_BEFORE:
                        $formatted[] = self::getConditionString($condition, "`:column` <= ':value'");
                        break;
                    case Filter::DATE_AFTER:
                        $formatted[] = self::getConditionString($condition, "`:column` >= ':value'");
                        break;
                    case Filter::STRING_EQUALS:
                    case Filter::ENUM_SELECT:
                    case Filter::ENUM_INPUT:
                        $formatted[] = self::getConditionString($condition, "`:column` = ':value'");
                        break;
                }

            }
        }

        return implode(' AND ', $formatted);
    }

    public static function getConditionString($condition, $conditionString)
    {
        $innerConditions = [];
        
        foreach ($condition['cols'] as $col) {

            $replace = array(':column' => $col);
            
            if (is_array($condition['value'])) {
                foreach ($condition['value'] as $suffix => $value) {
                    $replace[':value_' . $suffix] = $value;
                }
            } else {
                $replace[':value'] = $condition['value'];
            }

            $innerConditions[] = strtr($conditionString, $replace);
        }

        return '(' . implode(' OR ', $innerConditions) . ')';
    }
}
