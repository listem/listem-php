<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Textbox;

class StringContains extends AbstractFilterOption implements FilterOptionInterface
{

	/**
	 * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    protected function getInputs()
    {
        $input = new Textbox('text', $this->entity, $this->filter, $this->parameters);

        return array($input);
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
            $conditions[] = array($column, 'LIKE', '%' . $this->parameters . '%');  
        }

        return $conditions;
    }
}
