<?php 

/** 
* Generated at: 2018-02-14T14:51:46+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 81.18.148.142


Fields Summary: 
- name [input]
- rate [numeric]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Currency\Listing getByName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Currency\Listing getByRate ($value, $limit = 0) 
*/

class Currency extends Concrete {

public $o_classId = 8;
public $o_className = "currency";
public $name;
public $rate;


/**
* @param array $values
* @return \Pimcore\Model\Object\Currency
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get name - name
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	return $data;
}

/**
* Set name - name
* @param string $name
* @return \Pimcore\Model\Object\Currency
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get rate - rate
* @return float
*/
public function getRate () {
	$preValue = $this->preGetValue("rate"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->rate;
	return $data;
}

/**
* Set rate - rate
* @param float $rate
* @return \Pimcore\Model\Object\Currency
*/
public function setRate ($rate) {
	$this->rate = $rate;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

