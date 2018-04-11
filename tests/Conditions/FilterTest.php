<?php

namespace Listem\Tests\Conditions;

use PHPUnit\Framework\TestCase;
use Listem\Tests\Setup;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;

class FilterTest extends TestCase
{
    use Setup;

    public function testIfNoParametersAreSetNoConditionsAreReturned()
    {
        $params = new QueryString();
        $list = new ListEntity($this->configWithFilterWithOutDefault, new MySQL, $params);
        $filters = $list->getFilters();

        $conditions = $filters->getConditions();
        $this->assertTrue($conditions);
    }

    public function testIfMultipleConditionsInMySqlAreSeperatedByAnd()
    {
        $_GET = $this->paramData;

        $params = new QueryString();
        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();
        
        $conditions = $filters->getConditions();
        $this->assertRegexp('/AND/', $conditions);
    }

    public function testIfNoParametersAreSetOnlyDefaultValuesAreReturnedInConditions()
    { 
        $_GET = $this->paramData;
        $params = new QueryString();
        $list = new ListEntity($this->configWithFilterWithDefault, new MySQL, $params);
        $filters = $list->getFilters();

        $conditions = $filters->getConditions();

        $this->assertEquals("(`name` LIKE '%Sample Name%')" , $conditions);  
    }

    public function testIfFilterHasMultipleColumnsConditionWillHaveThemSeperatedByOr()
    {
        $_GET = $this->paramData;

        $params = new QueryString();
        $list = new ListEntity($this->config, new MySQL, $params);
        $filters = $list->getFilters();

        $conditions = $filters->getConditions();
        $this->assertRegexp('/OR/', $conditions);
    }
}
