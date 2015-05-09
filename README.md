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

```
// Initialize Listr by passing your configurations array
$listr = new Devrtips\Listr\Listr($config);

// Load filters and sorters for the given entity
$listr->getFiltersAndSorters('entity');

// This will enable you to access the filters with $listr->filters
// and sorters with $listr->sorters

// Or you can choose to load just one or both of them seperately
$listr->getFilters('entity');
$listr->getSorters('entity');
```
