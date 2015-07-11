<?php

namespace Devrtips\Listr;

use Devrtips\Listr\Collection\Collection;
use Devrtips\Listr\Builder\FilterBuilder;
use Exception;

class Sorter
{

	/**
     * Name of the entity which the filters belong to. Also known as identifier.
     *
     * @var string
     */
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function getOrder(){
        return Query::getSortOrders($this->entity);
    }
}
