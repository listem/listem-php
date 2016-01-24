<?php

namespace Devrtips\Listr\Tests;

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

trait Setup 
{
    protected $config;
    protected $filters;

    public function setUp()
    {
        $this->config = array(
            'blog' => array(
                'filters' => array(
                    'name'      => array('label' => 'Donor Name'),
                    'email'   => array('label' => 'Email', 'column' => array('name', 'email')),
                    'dob'       => array('label' => 'Date of Birth', 'type' => Filter::DATE),
                    'blood_group_id'    => array('label' => 'Blood Group', 'type' => Filter::ENUM_SELECT),
                    'gender'    => array('label' => 'Gender', 'type' => Filter::ENUM_INPUT)
                )
            ),
        );

        Listr::setConfig($this->config);

        $this->filters = Listr::getFilters('blog');
    }
}