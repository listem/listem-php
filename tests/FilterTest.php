<?php

namespace Listem\Tests;

use PHPUnit\Framework\TestCase;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;

class FilterTest extends TestCase
{
    use Setup;
       
    /**
     * Get filters group
     */
    public function testGetFiltersGroup()
    {
        
        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $this->filters = $list->getFilters();

        $this->assertInstanceOf('Listem\FilterManager', $this->filters);
    }

    /**
     * Cannot get uninitialized filters group
     */
    public function testCannotGetUninitializedFiltersGroup()
    {
        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $this->filters = $list->getFilters();

        $this->setExpectedException(
            'Exception',
            'Default values can be set for enum types only.'
        );

        $expectedValue = 'John Doe';
        $this->filters->setDefaultValue('name', 'John Doe');
    }

    /**
     * Get filter
     */
    public function testGetFilter()
    {
        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $this->filters = $list->getFilters();

        $this->assertInstanceOf(
            'Listem\Filter\Filter', 
            $this->filters->getFilter('name')
        );
    }

    /**
     * Cannot get uninitialized filter
     */
    public function testCannotGetUninitializedFilter()
    {
        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $this->filters = $list->getFilters();

        $this->setExpectedException(
            'OutOfBoundsException',
            "Filter 'deleted' does not exist."
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

        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->configWithFilterWithoutLabel, new MySQL, $params);
    }

    /**
     * Column name defaults to filter key
     */
    public function testColumnNameDefaultsToFilterKey()
    {
        $_GET = $this->paramData;

        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $filterKey = 'name';
        $nameFilter = $filters->getFilter($filterKey);
        $nameFilterOption = $nameFilter['options']->where('active', 1)->first();
        $columnName = $nameFilterOption['settings']['columns'][0];
        $this->assertEquals($filterKey, $columnName);

        return $nameFilterOption;
    }

    /**
     * Filter type defaults to string
     *
     * @depends testColumnNameDefaultsToFilterKey
     */
    public function testFilterTypeDefaultsToString($nameFilterOption)
    {
        $this->assertInstanceOf(
            'Listem\Filter\Options\StringContains',
            $nameFilterOption
        );
    }

    /**
     * Multiple columns can be set per filter
     */
    public function testMultipleColumnsCanBeSet()
    {
        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $contentFilter = $filters->getFilter('content');
        $filterColumns = $contentFilter['options']->where('active', 1)
            ->first()['settings']['columns'];

        $configColumns = $this->config['filters']['content']['column'];

        $this->assertGreaterThan(1, count($filterColumns));
        $this->assertEquals($configColumns, $filterColumns);
    }

    /**
     * Default enums are set if no enums are given
     */
    public function testDefaultEnumsSetIfNotGiven()
    {
        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $categoryFilter = $filters->getFilter('category');
        $enums = $categoryFilter['options']->where('active', 1)
            ->first()
            ->getInputs()[0]
            ->getEnums();

        $this->assertEquals(
            \Listem\Filter\Options\EnumInput::$DEFAULT_OPTIONS,
            $enums
        );
    }

    public function testDefaultCanBeSetDynamicallyForEnumTypesOnly()
    {
         $this->setExpectedException(
            'Exception',
            'Default values can be set for enum types only.'
        );

        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $filter = $filters->getFilter('name')
            ->setDefault('test');
    }

    public function testCanSetDefaultValueDynamically()
    {
        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $expectedValue = 'test';

        $filter = $filters->getFilter('state')
            ->setDefault($expectedValue);

        $filter = $filter['options']->where('active', 1)
            ->first();

        $this->assertEquals($filter['settings']['default'], $expectedValue);
    }

    public function testCanSetEnumsDynamically()
    {
        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $categories = [1 => 'General', 2 => 'News', 3 => 'Entertainment'];
        
        $filters->getFilter('category')->setEnums($categories, 'All Categories');
        $enums = $filters->getFilter('category')['options']
            ->where('active', 1)
            ->first()
            ->getInputs()[0]
            ->getEnums();

        unset($enums['any']);
        $this->assertEquals(array_values($categories), array_values($enums));
    }

    public function testCannotSetEnumsDynamicallyForNonEnumTypes()
    {
        $this->setExpectedException(
            'Exception',
            "Dynamically enums values can be set for enum types only."
        );

        $_GET = $this->paramData;
        $params = new QueryString();

        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $categories = [1 => 'General', 2 => 'News', 3 => 'Entertainment'];

        $filters->getFilter('name')
            ->setEnums($categories, 'All Categories');
    }
}
