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
            'title' => 'Test Title'
        ];
    }

    public function testIfNoParametersAreSetNoConditionsAreReturned()
    {
        $conditions = $this->filters->getConditions();
    }

    public function testIfMultipleConditionsInMySqlAreSeperatedByAnd()
    {
        
    }

    public function testIfNoParametersAreSetOnlyDefaultValuesAreReturnedInConditions()
    {
        
    }

    public function testIfFilterHasMultipleColumnsConditionWillHaveThemSeperatedByOr()
    {

    }
}
