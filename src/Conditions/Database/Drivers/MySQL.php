<?php

namespace Listem\Conditions\Database\Drivers;

class Mysql extends DriverAdapter
{
    public function generateCondition($condition, $conditionString)
    {
        $innerConditions = [];
        
        foreach ($condition['cols'] as $col) {
            $replace = array(':column' => $this->prepareColumnName($col));
            
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
    
    public function getStringContainsCondition($condition)
    {
        $conditionString = ":column LIKE '%:value%'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getStringBeginsWithCondition($condition)
    {
        $conditionString =  ":column LIKE ':value%'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getStringEndsWithCondition($condition)
    {
        $conditionString = ":column LIKE '%:value'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getDateBetweenCondition($condition)
    {
        $conditionString = ":column >= ':value_from' AND :column <= ':value_to'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getDateBeforeCondition($condition)
    {
        $conditionString = ":column <= ':value'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getDateAfterCondition($condition)
    {
        $conditionString = ":column >= ':value'";
        return $this->generateCondition($condition, $conditionString);
    }

    public function getStringEqualsCondition($condition)
    {

    }

    public function getEnumSelectCondition($condition)
    {

    }

    public function getEnumInputsCondition($condition)
    {
        $conditionString = ":column = ':value'";
        return $this->generateCondition($condition, $conditionString);
    }

    protected function prepareColumnName($column)
    {
        $parts = explode('.', $column);

        // Handle column names which contain the table name
        if (count($parts) > 1) {
            return "`{$parts[0]}`.`{$parts[1]}`";
        }

        return "`{$column}`";
    }
}
