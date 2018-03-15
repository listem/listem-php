# Filters

## Config options

A filter can be configured using the following options. 

| Key | Type | Default | Note |
|---|---|---|---|
| `column` | `String / Array` | Defaults to config array key | Name of the database table column. Specify array with multiple column names to match filter against columns with conditional OR. |
| `label` | `String` | | Display text for the filter. |
| `type` |  | `STRING_CONTAINS` | Defines the type of filter. See [Filter Types](#filter-types) section below. |
| `active` | `Boolean` | `true` | Indicate whether filter should be active. If `false` will be omitted from the filters list when generating the filters Form, or taken into account when generating conditions for the database. |
| `default` |  | `null` | Default value for the filter. |
| `enums` | `Array` | | List of enums. Only applies if filter type is an enumerated type.  |

#### Example

```php
use Listem\Filter;

$config = [
    'posts' => [
        'title' => ['label' => 'Title'],
        // This is identical to the below method of setting a filter
        
        'title'	=> [
            'label' => 'Title', 
            'column' => 'title', 
            'type' => Filter::STRING_CONTAINS
       	],
        // The key of the options array is used as the column name (which is `title`),
        // and the filter type is Filter::STRING_CONTAINS by default
    ]
];
```

## Filter Types

These are the available filter types that should be used when initializing a filter. These are constants defined in `Listem\Filter` so they should be used in the form of `Listem\Filter::STRING`. 

If no filter is specified explicitly, when registering a filter, `STRING` type will be used by default.  

1. [`STRING` / `STRING_CONTAINS`](#1-string--string_contains)
2. [`STRING_EQUALS`](#2-string_equals)
3. [`STRING_BEGINS_WITH`](#3-string_begins_with)
4. [`STRING_ENDS_WITH`](#4-string_ends_with)
5. [`DATE` / `DATE_BETWEEN`](#5-date--date_between)
6. [`DATE_BEFORE`](#6-date_before)
7. [`DATE_AFTER`](#7-date_after)
8. [`ENUM` / `ENUM_SELECT`](#8-enum--enum_select)
9. [`ENUM_INPUT`](#9-enum_input)

### 1. `STRING` / `STRING_CONTAINS`

Checks for a match anywhere inside the text.

###### Condition

```sql
LIKE '%string%'
```

###### Html

```html
<input type="text" />
```

### 2. `STRING_EQUALS`

Checks whether text is equal to the input.

###### Condition

```sql
= 'string'
```

###### Html

```html
<input type="text" />
```

### 3. `STRING_BEGINS_WITH`

Checks for a match from the beginning of the text.

###### Condition

```sql
LIKE '%string'
```

###### Html

```html
<input type="text" />
```

### 4. `STRING_ENDS_WITH`

Checks for a match from the end of the text.

###### Condition

```sql
LIKE 'string%'
```

###### Html

```html
<input type="text" />
```

### 5. `DATE` / `DATE_BETWEEN`

Checks for a date in the database that reside between the given _from_ and _to_ date. If only _from_ date is given, this defaults to `DATE_AFTER`. Likewise if only _to_ date is given, this defaults to `DATE_BEFORE`.

###### Condition

```sql
LIKE 'string%'
```

###### Html

```html
<input type="text" name="from_date" />
<input type="text" name="to_date" />
```

### 6. `DATE_BEFORE`

Checks for a date before or similar the given date.

###### Condition

```sql
>= date
```

###### Html

```html
<input type="text" name="to_date" />
```

### 7. `DATE_AFTER`

Checks for a date after or similar the given date.

###### Condition

```sql
<= date
```

###### Html

```html
<input type="text" name="from_date" />
```

### 8. `ENUM` / `ENUM_SELECT`

Checks for values matching the currently selected enum value.

###### Condition

```sql
= value
```

###### Html

```html
<select name="fruit">
  <option value="1">Apple</option>
  <option value="2">Orange</option>
</select>
```

### 9. `ENUM_INPUT`

Checks for values matching the currently selected enum value.

###### Condition

```sql
= value
```

###### Html

```html
<input type="radio" name="state" value="0">
<input type="radio" name="state" value="1">
```