# Listem

[![Latest Version on Packagist][ico-version]][link-packagist]   
[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.org/listem/listem-php.svg?branch=master)](https://travis-ci.org/listem/listem-php)
[![Total Downloads][ico-downloads]][link-downloads]

Listem is an easy to use (but highly customizable) data sorting and filtering module for PHP >= 5.4, which can be used for data lists/tables/grids, reports or APIs.

## Installation

Make sure you have [Composer installed](https://getcomposer.org/doc/00-intro.md#globally) and run the below command from your project directory.

```bash
composer require listem/listem-php
```

## General Usage

Set configurations and initialize.

```php
$config = [
    'filters' => [
        'name' => ['label' => 'Title'],
        'content' => ['label' => 'Content', 'column' => ['content', 'summary']],
        'state' => [
            'label' => 'State',
            'type' => Listem\Filter::ENUM_INPUT,
            'enums' => [
                1 => 'Active',
                0 => 'Draft'
            ]
        ],
        'created_at' => ['label' => 'Created On', 'type' => Listem\Filter::DATE],
        'category' => ['label' => 'Category', 'type' => Listem\Filter::ENUM_SELECT]
    ],
    'sorters' => [
        'name' => ['label' => 'Full Name', 'column' => 'users.name'],
        'active' => ['label' => 'Active', 'column' => 'users.active']
    ]
];

$list = new Listem\ListEntity($config, new Listem\Conditions\MySQL, new Listem\Params\Get);

$filters = $list->getFilters();
$sorters = $list>getSorters();

$filterConditions = $filters->getConditions();

$sorterConditions = $sorters->getConditions();

$data = BlogPost::whereRaw($condition);
    ->orderBy($sorterConditions['column'], $sorterConditions['side'])
    ->get()
    ->toArray();
```


Pass `$filters` and `$sorters` to your view and render them easily.

```html
<form method="GET" class="form-horizontal"> <!-- Should be submitted to the current page -->
    <?php 
	foreach($filters as $filter): 
		$filter = new Listem\Html\Decorators\Bootstrap3($filter);
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

## Documentation

- [Filters](docs/filters.md)   

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.