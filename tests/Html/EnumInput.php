<?php

namespace Listem\Tests\Html;

use PHPUnit\Framework\TestCase;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;
use Listem\Tests\Setup;

class EnumInput extends TestCase
{
    use Setup;

    public function testRenderEnumInput()
    {
        $list = new ListEntity($this->config, new MySQL, new QueryString);
        $filters = $list->getFilters();

        $filter = $filters->getFilter('state');
        $filter = $filter['options']->where('active', 1)
            ->first();
        
        $filterRadioHtml = $filter->getInputs()[0]->render();
        $expectedRadio = <<<Html
<label ><input value="1" type="radio" name="state"/> Active</label>\n
Html;
        $this->assertEquals($filterRadioHtml, $expectedRadio);  
    }

}
