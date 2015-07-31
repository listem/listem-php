<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Radio;

class BooleanEquals extends AbstractFilterOption
{

    /**
	 * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    protected function getInputs()
    {
        $inputs[] = new Radio($this->entity, $this->filter, 1, $this->parameters, 'True');
        $inputs[] = new Radio($this->entity, $this->filter, 0, $this->parameters, 'False');

        return $inputs;
    }

    /**
     * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    public function getQuery()
    {
        $conditions = array();

        foreach($this->config['columns'] as $column){
            $conditions[] = array($column, '=', $this->parameters);  
        }

        return $conditions;
    }

}
