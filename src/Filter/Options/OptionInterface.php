<?php

namespace Devrtips\Listr\Filter\Options;

interface OptionInterface
{
    public function render();

    public function getInputs();
}