<?php

namespace Devrtips\Listr\Tests;

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    use Setup;
    
    public function testGetFiltersGroup()
    {
        $this->assertInstanceOf(\Devrtips\Listr\Filter::class, $this->filters);
    }

    public function testCannotGetUninitializedFiltersGroup()
    {
        $this->setExpectedException(
            'OutOfBoundsException',
            "Filter group 'users' does not exist."
        );

        $filters = Listr::getFilters('users');
    }

    public function testGetFilter()
    {
        $this->assertInstanceOf(Filter::class, $this->filters->getFilter('title'));
    }

    public function testCannotGetUninitializedFilter()
    {
        $this->setExpectedException(
            'OutOfBoundsException',
            "Filter 'deleted' does not exist in 'blog'."
        );

        $this->filters->getFilter('deleted');
    }

    public function testFilterCannotBeCreatedWithoutLabel()
    {
        $this->setExpectedException(
            'Exception',
            "Label needed for filter 'content'."
        );

        Listr::setConfig($this->configWithFilterWithoutLabel);
    }

    public function testColumnNameDefaultsToFilterKey()
    {
        $filterKey = 'title';
        $titleFilter = $this->filters->getFilter($filterKey);
        $titleFilterOption = $titleFilter['options']->where('active', 1)->first();
        $columnName = $titleFilterOption['settings']['columns'][0];

        $this->assertEquals($filterKey, $columnName);

        return $titleFilterOption;
    }

    /**
     * @depends testColumnNameDefaultsToFilterKey
     */
    public function testFilterTypeDefaultsToString($titleFilterOption)
    {
        $this->assertInstanceOf(\Devrtips\Listr\Filter\Options\StringContains::class, $titleFilterOption);
    }

    public function testMultipleColumnsCanBeSet()
    {
        $contentFilter = $this->filters->getFilter('content');
        $filterColumns = $contentFilter['options']->where('active', 1)->first()['settings']['columns'];

        $configColumns = $this->blogConfig['blog']['filters']['content']['column'];

        $this->assertEquals($configColumns, $filterColumns);
    }

    public function testDefaultEnumsSetIfNotGiven()
    {
        $categoryFilter = $this->filters->getFilter('category');
        $enums = $categoryFilter['options']->where('active', 1)->first()['inputs'][0]->getEnums();

        $this->assertEquals(\Devrtips\Listr\Filter\Options\EnumInput::$DEFAULT_OPTIONS, $enums);
    }
    
}
