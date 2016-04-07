# Listr

[![Build Status](https://travis-ci.org/devrtips/listr.svg?branch=master)](https://travis-ci.org/devrtips/listr)

Listr is an easy to use (but highly customizable) data sorting and filtering module for PHP >= 5.4, which can be used for data lists/tables/grids, reports or APIs.


## Installation via Composer

Make sure you have [Composer installed](https://getcomposer.org/doc/00-intro.md#globally) and simply run the below command from your project root.

`composer require devrtips/listr`

## Usage

Set your configurations and initialize.
```php
<?php

use Devrtips\Listr\Listr;
use Devrtips\Listr\Filter\Filter;

$config = array( 
    'blog' => array(
    	'title' => array('label' => 'Title'),
    	// This is identical to the below method of setting a filter
        // 'title' 	=> array(
        //   	'label' => 'Title', 
        //   	'column' => 'title', 
        //   	'type' => Filter::STRING_CONTAINS
       	//	),
        // The key is used as the column name (which is `title`),
        // and the filter type is Filter::STRING_CONTAINS by default
        
        // You can specify multiple columns for a single filter
        'content' => array('label' => 'Content', 'column' => ['content', 'summary']),

        'created_at' => array('label' => 'Created On', 'type' => Filter::DATE),

        'state' => array(
        	'label' => 'State', 
        	'type' => Filter::ENUM_INPUT, 
        	'enums' => array (1 => 'Active', 0 => 'Draft'), 
        	'default' => null
    	),

        // Enum values for this filter needs to be set dynamically
        'category' => array('label' => 'Category', 'type' => Filter::ENUM_SELECT)
    )
);

// Initialize Listr by passing your configurations array.
// This is typically done in a service provider or initially one time at bootstrap.
Listr::setConfig($config);

$filters = Listr::getFilters('blog');
$sorters = Listr::getSorters('blog');

// Populate enum types with dynamic data
$categories = Categories::all()->lists('name', 'id');
// [1 => 'General', 2 => 'News', 3 => 'Entertainment']
// Second argument of setEnums() is the text shown for the 'all' option.
$filters->getFilter('category')->setEnums($categories, 'All Categories');

// Set the default enum
$filters->getFilter('state')->setDefault(1);

// Get array of current conditions/inputs set for the filters
$conditions = $filters->getConditions();

// Get data according to the set conditions
$blogs = Blog::orderBy('created_at', 'desc');
$blogs = $blogs->whereRaw($conditions);
```

Pass to your view and render.
```html
<form method="GET" class="form-horizontal"> <!-- Should be submitted to the current page -->
    <?php 
	foreach($filters as $filter): 
		$filter = new \Devrtips\Listr\Html\Decorators\Bootstrap3($filter);
	?>
        <div class="form-group">
            <?php echo $filter->renderLabel() ?>
            <?php echo $filter->renderFormElem() ?>
        </div>
    <?php endforeach; ?>
    <button type="reset">Reset</button>
    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th><?php $sorters->render('title') ?></th>
            <th>Slug</th>
            <th><?php $sorters->render('content') ?></th>
            <!-- Or you can render parts of it, so you have more control -->
            <th>
                <a href="<?php $sorters->getLink('created_at') ?>">
                    <?php $sorters->getLabel('created_at') ?>
                    <span class="<?php $sorters->sorted('created_at') ? 'up' : 'down' ?>"></span>
                </a>
            </th>
        </tr>
    </thead>

    ...
```

## Filter config parameters

Eg: 

```php
'state' => array(
    'label' => 'State', 
    'type' => Filter::ENUM_INPUT, 
    'enums' => array (1 => 'Active', 0 => 'Draft'), 
    'default' => null
)
```

| Param | Required | Default |Description |
|---|---|---|---|
| `column` | No | Defaults to configs array key | `string|array` Name of the database table column. Specify array with multiple column names to match filter against columns with conditional OR. |
| `label` | Yes | | Display text for the filter. |
| `type` | No | `Filter::STRING_CONTAINS` | See [Filter Types](#filter-types) section below. |
| `active` | No | `true` | `Boolean` indicating whether filter should be active. If `false` will be omitted from the filters list when generating the filters Form, or taken into account when generating conditions for the database. |
| `default` | No | `null` | Default value for the filter. |
| `enums` | No | | List of enums. Only applies if filter type is an enumerated type.  |


## Filter Types

These are the available filter types that should be used when initializing a filter. These are constants defined in `Devrtips\Listr\filter` so they should be used in the form of `Devrtips\Listr\filter::STRING`. 

Note: If no filter is specified by you when registering a filter, `STRING` type will be used by default.  


| Filter Type | Description | HTML        |
|-------------|-------------|-------------|
| `STRING` / `STRING_CONTAINS`    | Checks for a match anywhere inside the text (`LIKE '%string%'`) | Text input (`<input type="text" ..`) |
| `STRING_EQUALS`      | Checks whether text is equal to the input (`= 'string'`) | Text input |
| `STRING_BEGINS_WITH` | Checks for a match from the beginning of the text (`LIKE 'string%'`) | Text input |
| `STRING_ENDS_WITH` | Checks for a match from the end of the text (`LIKE 'string%'`) | Text input |
| `DATE` / `DATE_BETWEEN` | Checks for a date in the database that reside between the given _from_ and _to_ date. If only _from_ date is given, this defaults to `DATE_AFTER`. Likewise if only _to_ date is given, this defaults to `DATE_BEFORE` | 2 text inputs for `from` and `to` dates |
| `DATE_BEFORE` | Checks for a date before or similar the given date (`>= 'date'`) | Text input |
| `DATE_AFTER` | Checks for a date after or similar the given date (`<= 'date'`) | Text input |
| `ENUM` / `ENUM_SELECT` | Checks for values matching the currently selected enum value (`= 'value'`) | Dropdown (`<select ..`) |
| `ENUM_INPUT` | Same as `ENUM_SELECT` | Radio buttons (`<input type="radio" ..`) |



## Checklist

- Persistence using sessions (without using URL parameters).
- Ability to save filter/sorter settings to a DB and retrieve them.
- Support other popular DB types other than MySQL (MongoDB, etc.).