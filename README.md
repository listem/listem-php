# Listr

Listr is an easy to use (but highly customizable) data sorting and filtering module for PHP, that can be used for data lists/tables/grids, reports or APIs.


## Installation via Composer

Add Listr to your composer.json file

```
"require" : {
    "devrtips/listr" : "dev-master"
}
```

And install via composer

`composer install`


## Usage

Set your configurations and initialize
```
$config = array();

// Initialize Listr by passing your configurations array
$listr = new Devrtips\Listr\Listr($config);

// Load filters and sorters for the given entity
$listr->setFiltersAndSorters('entity');

// This will enable you to access the filters with $listr->filters
// and sorters with $listr->sorters

// Or you can choose to load just one or both of them seperately
$listr->setFilters('entity');
$listr->setSorters('entity');
```

Pass to your view and render
```
<html>
...

<?php $listr->render(); ?>
```

Viola!


## Checklist

- Persistence using sessions (without using URL parameters)
- Save filter/sorter settings to a DB
- Support other DB types other than MySQL