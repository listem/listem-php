<?php

namespace Listem\Tests\Html;

use PHPUnit\Framework\TestCase;
use Listem\ListEntity;
use Listem\Filter\Filter;
use Listem\Parameter\QueryString;
use Listem\Conditions\Database\Drivers\Mysql as MySQL;
use Listem\Tests\Setup;

class StringContains extends TestCase
{
    use Setup;

    public function testRenderTextInput()
    {
    	$_GET = $this->paramData;
        $list = new ListEntity($this->config, new MySQL, new QueryString);
        $filters = $list->getFilters();

    	$filter = $filters->getFilter('name');
    	$filter = $filter['options']->where('active', 1)
            ->first();
        
        $filterTextboxHtml = $filter->getInputs()[0]->render();
        
        $expectedTextbox =  <<<Html
<input type="text" name="name" value="Sample Name"/>\n
Html;

        $this->assertEquals($filterTextboxHtml, $expectedTextbox);	
    }

    public function testRenderLabel()
    {
    	$_GET = $this->paramData;
        $list = new ListEntity($this->config, new MySQL, new QueryString);
        $filters = $list->getFilters();

    	$filter = $filters->getFilter('name');
    	$filterLableHtml = $filter['label']->render();

    	$expectedLableHtml =  <<<Html
<label >Title</label>\n
Html;
		$this->assertEquals($filterLableHtml, $expectedLableHtml);
    }
}