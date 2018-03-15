<?php

namespace Listem\Tests;

use Listem;
use Listem\Filter\Filter;

trait Setup
{
    public $config = array(
        'filters' => [
            'name' => array('label' => 'Title'),
            'content' => array('label' => 'Content', 'column' => ['content', 'summary']),
            'created_at' => array('label' => 'Created On', 'type' => Filter::DATE),
            'state'    => array(
                'label' => 'State',
                'type' => Filter::ENUM_INPUT,
                'enums' => array(
                    1 => 'Active',
                    0 => 'Draft'
                )
            ),
            'category'    => array('label' => 'Category', 'type' => Filter::ENUM_SELECT)
        ],
        'sorters' => [
            'name' => ['label' => 'Full Name', 'column' => 'users.name'],
            'active' => ['label' => 'Active', 'column' => 'users.active'],
        ],
        'default_sort' => 'name:desc'
    );

    public $paramData = array(
        'name' => 'Sample Name',
        'content' => 'Sample content'
    );

    protected $configWithFilterWithoutLabel = array(
        'filters' => array(
            'content' => array(
                'column' => array('content', 'summary')
            )
        )
    );

    protected $configWithFilterWithDefault = array(
        'filters' => array(
            'name' => array('label' => 'Title', 'default' => 'title')
        )
    );

    protected $configWithFilterWithOutDefault = array(
        'filters' => array(
            'name' => array('label' => 'Title')
        )
    );

    protected $filters;

    public function setUp()
    {
        
    }
}
