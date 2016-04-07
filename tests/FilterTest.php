<?php

namespace Devrtips\Listr\Tests;

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    use Setup;
    
    /**
     * Get filters group
     */
    public function testGetFiltersGroup()
    {
        $this->assertInstanceOf('Devrtips\Listr\Filter', $this->filters);
    }

    /**
     * Cannot get uninitialized filters group
     */
    public function testCannotGetUninitializedFiltersGroup()
    {
        $this->setExpectedException(
            'OutOfBoundsException',
            "Filter group 'users' does not exist."
        );

        $filters = Listr::getFilters('users');
    }

    /**
     * Get filter
     */
    public function testGetFilter()
    {
        $this->assertInstanceOf(
            'Devrtips\Listr\Filter\Filter', 
            $this->filters->getFilter('title')
        );
    }

    /**
     * Cannot get uninitialized filter
     */
    public function testCannotGetUninitializedFilter()
    {
        $this->setExpectedException(
            'OutOfBoundsException',
            "Filter 'deleted' does not exist in 'blog'."
        );

        $this->filters->getFilter('deleted');
    }

    /**
     * Filter cannot be created without label
     */
    public function testFilterCannotBeCreatedWithoutLabel()
    {
        $this->setExpectedException(
            'Exception',
            "Label needed for filter 'content'."
        );

        Listr::setConfig($this->configWithFilterWithoutLabel);
    }

    /**
     * Column name defaults to filter key
     */
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
     * Filter type defaults to string
     *
     * @depends testColumnNameDefaultsToFilterKey
     */
    public function testFilterTypeDefaultsToString($titleFilterOption)
    {
        $this->assertInstanceOf(
            'Devrtips\Listr\Filter\Options\StringContains',
            $titleFilterOption
        );
    }

    /**
     * Multiple columns can be set per filter
     */
    public function testMultipleColumnsCanBeSet()
    {
        $contentFilter = $this->filters->getFilter('content');
        $filterColumns = $contentFilter['options']->where('active', 1)
            ->first()['settings']['columns'];

        $configColumns = $this->blogConfig['blog']['filters']['content']['column'];

        $this->assertGreaterThan(1, count($filterColumns));
        $this->assertEquals($configColumns, $filterColumns);
    }

    /**
     * Default enums are set if no enums are given
     */
    public function testDefaultEnumsSetIfNotGiven()
    {
        $categoryFilter = $this->filters->getFilter('category');
        $enums = $categoryFilter['options']->where('active', 1)
            ->first()
            ->getInputs()[0]
            ->getEnums();

        $this->assertEquals(
            \Devrtips\Listr\Filter\Options\EnumInput::$DEFAULT_OPTIONS,
            $enums
        );
    }

    public function testCanSetDefaultValueDynamically()
    {
        
    }

    public function testCanSetEnumsDynamically()
    {
        
    }

    public function testCannotSetEnumsDynamicallyForNonEnumTypes()
    {
        
    }

    public function testCanSetDefaultEnumDynamically()
    {
        
    }
}
