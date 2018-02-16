<?php 

/** 
* Generated at: 2018-02-14T15:46:01+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 81.18.148.142


Fields Summary: 
- name [input]
- categoryid [numeric]
- xmlid [numeric]
- xmlparentid [numeric]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Category\Listing getByName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Category\Listing getByCategoryid ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Category\Listing getByXmlid ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Category\Listing getByXmlparentid ($value, $limit = 0) 
*/

class Category extends Concrete {

public $o_classId = 9;
public $o_className = "category";
public $name;
public $categoryid;
public $xmlid;
public $xmlparentid;


/**
* @param array $values
* @return \Pimcore\Model\Object\Category
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
* @return \Pimcore\Model\Object\Category
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get categoryid - categoryid
* @return float
*/
public function getCategoryid () {
	$preValue = $this->preGetValue("categoryid"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->categoryid;
	return $data;
}

/**
* Set categoryid - categoryid
* @param float $categoryid
* @return \Pimcore\Model\Object\Category
*/
public function setCategoryid ($categoryid) {
	$this->categoryid = $categoryid;
	return $this;
}

/**
* Get xmlid - xmlid
* @return float
*/
public function getXmlid () {
	$preValue = $this->preGetValue("xmlid"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->xmlid;
	return $data;
}

/**
* Set xmlid - xmlid
* @param float $xmlid
* @return \Pimcore\Model\Object\Category
*/
public function setXmlid ($xmlid) {
	$this->xmlid = $xmlid;
	return $this;
}

/**
* Get xmlparentid - xmlparentid
* @return float
*/
public function getXmlparentid () {
	$preValue = $this->preGetValue("xmlparentid"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->xmlparentid;
	return $data;
}

/**
* Set xmlparentid - xmlparentid
* @param float $xmlparentid
* @return \Pimcore\Model\Object\Category
*/
public function setXmlparentid ($xmlparentid) {
	$this->xmlparentid = $xmlparentid;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

