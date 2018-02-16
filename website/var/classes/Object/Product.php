<?php 

/** 
* Generated at: 2018-02-14T18:12:07+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: 82.208.124.245


Fields Summary: 
- name [input]
- xmlproductid [numeric]
- description [textarea]
- picture [image]
- categoryid [numeric]
- price [numeric]
- modified_datetime [datetime]
- currencyId [input]
- brand_name [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Product\Listing getByName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByXmlproductid ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByDescription ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPicture ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCategoryid ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByModified_datetime ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCurrencyId ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByBrand_name ($value, $limit = 0) 
*/

class Product extends Concrete {

public $o_classId = 1;
public $o_className = "product";
public $name;
public $xmlproductid;
public $description;
public $picture;
public $categoryid;
public $price;
public $modified_datetime;
public $currencyId;
public $brand_name;


/**
* @param array $values
* @return \Pimcore\Model\Object\Product
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
* @return \Pimcore\Model\Object\Product
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get xmlproductid - xmlproductid
* @return float
*/
public function getXmlproductid () {
	$preValue = $this->preGetValue("xmlproductid"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->xmlproductid;
	return $data;
}

/**
* Set xmlproductid - xmlproductid
* @param float $xmlproductid
* @return \Pimcore\Model\Object\Product
*/
public function setXmlproductid ($xmlproductid) {
	$this->xmlproductid = $xmlproductid;
	return $this;
}

/**
* Get description - description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	return $data;
}

/**
* Set description - description
* @param string $description
* @return \Pimcore\Model\Object\Product
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get picture - picture
* @return \Pimcore\Model\Asset\Image
*/
public function getPicture () {
	$preValue = $this->preGetValue("picture"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->picture;
	return $data;
}

/**
* Set picture - picture
* @param \Pimcore\Model\Asset\Image $picture
* @return \Pimcore\Model\Object\Product
*/
public function setPicture ($picture) {
	$this->picture = $picture;
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
* @return \Pimcore\Model\Object\Product
*/
public function setCategoryid ($categoryid) {
	$this->categoryid = $categoryid;
	return $this;
}

/**
* Get price - price
* @return float
*/
public function getPrice () {
	$preValue = $this->preGetValue("price"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price;
	return $data;
}

/**
* Set price - price
* @param float $price
* @return \Pimcore\Model\Object\Product
*/
public function setPrice ($price) {
	$this->price = $price;
	return $this;
}

/**
* Get modified_datetime - modified_datetime
* @return \Carbon\Carbon
*/
public function getModified_datetime () {
	$preValue = $this->preGetValue("modified_datetime"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->modified_datetime;
	return $data;
}

/**
* Set modified_datetime - modified_datetime
* @param \Carbon\Carbon $modified_datetime
* @return \Pimcore\Model\Object\Product
*/
public function setModified_datetime ($modified_datetime) {
	$this->modified_datetime = $modified_datetime;
	return $this;
}

/**
* Get currencyId - currencyId
* @return string
*/
public function getCurrencyId () {
	$preValue = $this->preGetValue("currencyId"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->currencyId;
	return $data;
}

/**
* Set currencyId - currencyId
* @param string $currencyId
* @return \Pimcore\Model\Object\Product
*/
public function setCurrencyId ($currencyId) {
	$this->currencyId = $currencyId;
	return $this;
}

/**
* Get brand_name - brand_name
* @return string
*/
public function getBrand_name () {
	$preValue = $this->preGetValue("brand_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->brand_name;
	return $data;
}

/**
* Set brand_name - brand_name
* @param string $brand_name
* @return \Pimcore\Model\Object\Product
*/
public function setBrand_name ($brand_name) {
	$this->brand_name = $brand_name;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

