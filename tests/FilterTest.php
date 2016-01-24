<?php

namespace Devrtips\Listr\Tests;

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{
	use Setup;

	public function testGetFilters()
	{
		$this->assertInstanceOf(\Devrtips\Listr\Filter::class, $this->filters);
	}

	public function testCannotGetUninitializedFiltersGroup()
	{
		$this->setExpectedException(
          'OutOfBoundsException', "Filter group 'users' does not exist."
        );

		$filters = Listr::getFilters('users');
	}

	public function testCannotGetUninitializedFilter()
	{
		$this->setExpectedException(
          'OutOfBoundsException', "Filter 'user' does not exist in 'blog'."
        );

		$this->filters->getFilter('user');
	}

	public function testFilterCannotBeCreatedWithoutLabel()
	{
		$this->setExpectedException(
          'Exception', "Label needed for filter 'email'."
        );

		$this->config = array(
			'blog' => array(
				'filters' => array(
					'email'   => array('column' => array('name', 'email'))
				)
			),
		);

		Listr::setConfig($this->config);
	}
}