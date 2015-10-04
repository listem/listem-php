<?php

namespace Devrtips\Listr\Builder\FilterOption;

use Devrtips\Listr\Builder\Html\Textbox;

class DateBetween extends AbstractFilterOption
{

    protected $inputs = array('from', 'to');

    /**
	 * @inherit
     * {@inherit}
     * {@inheritdoc}
     */
    protected function getInputs()
    {
// echo '<pre>', print_r($this, true);
// exit;
        foreach ($this->inputs as $input) {
            $inputs[] = new Textbox('text', $this->entity, [$this->filter, $input], $this->parameters[$input]);
        }

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
            $conditions['AND'] = array(
                array($column, '>', $this->parameters['from']), 
                array($column, '<', $this->parameters['to'])
            );  
        }

        return $conditions;
    }

}
