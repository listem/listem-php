<?php

namespace Devrtips\Listr\Query\Filter;

interface FilterQueryInterface
{

	public function getConditions();

	public function toString();

}