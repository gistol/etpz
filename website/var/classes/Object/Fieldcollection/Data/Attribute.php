<?php 

/** 
* Generated at: 2018-01-18T10:03:53+01:00
* IP: 81.18.148.142


Fields Summary: 
 - val [input]
*/ 

namespace Pimcore\Model\Object\Fieldcollection\Data;

use Pimcore\Model\Object;

class Attribute extends Object\Fieldcollection\Data\AbstractData  {

public $type = "Attribute";
public $val;


/**
* Get val - val
* @return string
*/
public function getVal () {
	$data = $this->val;
	 return $data;
}

/**
* Set val - val
* @param string $val
* @return \Pimcore\Model\Object\Attribute
*/
public function setVal ($val) {
	$this->val = $val;
	return $this;
}

}

