<?php

namespace Listem\Tests\Html;

use PHPUnit\Framework\TestCase;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;
use Listem\Tests\Setup;

class EnumSelect extends TestCase
{
    use Setup;

    public function testRenderEnumSelect()
    {    	
        $list = new ListEntity($this->config, new MySQL, new QueryString);
        $filters = $list->getFilters();

        $filter = $filters->getFilter('category');
        $filter = $filter['options']->where('active', 1)
            ->first();
        
        $filterSelectHtml = $filter->getInputs()[0]->render();
        
        $expectedSelect = <<<Html
<select name="category">
	<option value="any"></option>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
Html;
        $this->assertEquals($filterSelectHtml, $expectedSelect);  
    }

}