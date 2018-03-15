<?php

namespace Listem\Parameter;

interface ParameterInterface
{
    public function getFilterParam($inputName);

    public function getSorterParam();

    public function getFilterName($entityName);

    public function getSorterName();
}
