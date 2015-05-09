<?php

namespace Devrtips\Listr\Builder\FilterOption;

interface FilterOptionInterface
{

    public function getQuery();

    public function setParameters();

    public function getParameters();
}
