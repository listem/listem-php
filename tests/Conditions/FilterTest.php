<?php

namespace Devrtips\Listr\Tests\Conditions;

use PHPUnit\Framework\TestCase;
use Devrtips\Listr\Tests\Setup;
use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

class FilterTest extends TestCase
{
    use Setup;

    /**
     * @beforeClass
     */
    public static function setUpQueryParamsForConditions()
    {
        $_GET = [
            'title' => 'Test Title',
            'content' => 'Sample content'
        ];
    }

    public function testIfNoParametersAreSetNoConditionsAreReturned()
    {
        $conditions = $this->filters->getConditions();
    }

    public function testIfMultipleConditionsInMySqlAreSeperatedByAnd()
    {
        $conditions = $this->filters->getConditions();
        $this->assertRegexp('/AND/', $conditions);
    }

    public function testIfNoParametersAreSetOnlyDefaultValuesAreReturnedInConditions()
    {
        
    }

    public function testIfFilterHasMultipleColumnsConditionWillHaveThemSeperatedByOr()
    {
        $conditions = $this->filters->getConditions();
        $this->assertRegexp('/OR/', $conditions);
    }
}
