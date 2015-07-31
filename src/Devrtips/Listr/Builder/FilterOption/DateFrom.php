<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Textbox;

class DateFrom extends AbstractFilterOption
{

    /**
	 * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    protected function getInputs()
    {
        $input = new Textbox('text', $this->entity, $this->filter, $this->parameters);

        return [$input];
    }

}
