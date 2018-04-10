<?php

namespace Listem\Tests\Html;

use PHPUnit\Framework\TestCase;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;
use Listem\Tests\Setup;

class DateBetween extends TestCase
{
    use Setup;

    public function testRenderDateBetween()
    {
        $_GET = $this->paramData;
        $list = new ListEntity($this->config, new MySQL, new QueryString);
        $filters = $list->getFilters();

        $filter = $filters->getFilter('created_at');
        $filter = $filter['options']->where('active', 1)
            ->first();
        
        $filterDateBetweenFromHtml = $filter->getInputs()[0]->render();
        $filterDateBetweenToHtml = $filter->getInputs()[1]->render();

        $expectedDateBetweenFrom =  <<<Html
<input type="text" name="created_at_from" value="" placeholder="from"/>\n
Html;
        $this->assertEquals($filterDateBetweenFromHtml, $expectedDateBetweenFrom);

        $expectedDateBetweenTo =  <<<Html
<input type="text" name="created_at_to" value="" placeholder="to"/>\n
Html;
        $this->assertEquals($filterDateBetweenToHtml, $expectedDateBetweenTo);
    }
}