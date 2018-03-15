<?php

namespace Listem\Conditions\Database\Drivers;

interface DriverInterface
{
	public function generateCondition($condition, $conditionString);
	public function getStringContainsCondition($condition);
	public function getStringBeginsWithCondition($condition);
	public function getStringEndsWithCondition($condition);
	public function getDateBetweenCondition($condition);
	public function getDateBeforeCondition($condition);
	public function getDateAfterCondition($condition);
	public function getStringEqualsCondition($condition);
	public function getEnumSelectCondition($condition);
	public function getEnumInputsCondition($condition);
}