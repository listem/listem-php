# Listr

Listr is an easy to use (but highly customizable) data sorting and filtering module for PHP, that can be used for data lists/tables/grids, reports or APIs.


## Installation via Composer

Add Listr to your composer.json file.

```
"require" : {
    "devrtips/listr" : "dev-master"
}
```

And install via composer.

`composer install`


## Usage

Set your configurations and initialize.
```php
<?php

$config = array( 
    'filters' => array(
        'blog' => array(

            // 'column_name'        => options array
            'title'                 => array('label' => 'Title'),

            // You can override the column name
            'content'               => array('label' => 'Content', 'column' => 'content'),

            // Filter type is 'string' by default, or you can specify it as,
            // 'column_name|type'   => ...
            'created_at|date'       => array('label' => 'Created At Date'),

            // Or in the options array
            'active'                => array('label' => 'Active', 'type' => 'boolean')
        )
    )
);

// Initialize Listr by passing your configurations array.
$listr = new Devrtips\Listr\Listr($config);

// Load filters and sorters for the given entity.
$listr->setFiltersAndSorters('blog');

// This will enable you to access the filters with $listr->filters.
// and sorters with $listr->sorters

// Or you can choose to load just one or both of them seperately.
$listr->setFilters('entity');
$listr->setSorters('entity');
```

Pass to your view and render.
```html
<form method="GET"> <!-- Should be submitted to the current page -->
    <table>
    <?php foreach($listr->filters as $filter): ?>
        <tr>
            <td><?php $filter->renderLabel() ?></td>
            <td><?php $filter->renderInput() ?></td>
        </tr>
    <?php endforeach ?>
    </table>

    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th><?php $this->sorters->render('title') ?></th>
            <th>Slug</th>
            <th><?php $this->sorters->render('content') ?></th>
            <!-- Or you can render parts of it, so you have more control -->
            <th>
                <a href="<?php $this->sorters->getLink('created_at') ?>">
                    <?php $this->sorters->getLabel('created_at') ?>
                    <span class="<?php $this->sorters->sorted('created_at') ? 'up' : 'down' ?>"></span>
                </a>
            </th>
            <th><?php $this->sorters->render('active') ?></th>
        </tr>
    </thead>

    ...
```

Viola!


## Checklist

- Persistence using sessions (without using URL parameters).
- Ability to save filter/sorter settings to a DB and retrieve them.
- Support other popular DB types other than MySQL (MongoDB, etc.).