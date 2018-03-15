<?php

namespace Listem\Filter\Options;

interface OptionInterface
{
    public function render();

    public function getInputs();
}