<?php

namespace Devrtips\Listr\Html\Support;

class Attribute
{
    protected $attributes = array(
    	'class' => array()
	);

    public function setAttribute($attribute, $value)
    {
    	$this->attributes[$attribute] = ($attribute == 'class') ? [$value] : $value;

    	return $this;
    }

    public function removeAttribute($attribute)
    {
    	if (isset($this->attributes[$attribute])) {
    		unset($this->attributes[$attribute]);	
    	}
    	
    	return $this;
    }

    public function addClass($class)
    {


    	if (!array_search($class, $this->attributes['class'])) {
    		$this->attributes['class'][] = $class;	
    	}

    	return $this;
    }

    public function removeClass($class)
    {
    	if ((isset ($this->attributes['class'])) && ($key = array_search($class, $this->attributes['class'])) ) {
		    unset($this->attributes['class'][$key]);
		}

		return $this;
    }

    public function __toString()
    {
    	$preparedAttributes = array_filter($this->attributes, function($val) {
            return !($val === '' || $val === null);
        });

		if (isset($preparedAttributes['class']) &&
            is_array($preparedAttributes['class']) &&
            count($classes = array_filter($preparedAttributes['class']))) {
			$preparedAttributes['class'] = implode(' ', $classes);
        
		} else {
			unset($preparedAttributes['class']);
		}


		foreach($preparedAttributes as $attribute => &$value) {
			$value = "{$attribute}=\"{$value}\"";
		}

		return implode(' ', $preparedAttributes);
    }
}
