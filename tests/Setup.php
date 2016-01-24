<?php

namespace Devrtips\Listr\Tests;

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

trait Setup
{
    public $blogConfig = array(
        'blog' => array(
            'filters' => array(
                'title' => array('label' => 'Title'),
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
            )
        )

    );

    protected $configWithFilterWithoutLabel = array(
        'blog' => array(
            'filters' => array(
                'content' => array(
                    'column' => array('content', 'summary')
                )
            )
        )
    );

    protected $filters;

    public function setUp()
    {
        Listr::setConfig($this->blogConfig);

        $this->filters = Listr::getFilters('blog');
    }}
