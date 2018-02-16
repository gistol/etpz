<?php 

/** 
* Generated at: 2018-01-18T15:49:45+01:00
* IP: 81.18.148.142


Fields Summary: 
 - val [block]
*/ 

namespace Pimcore\Model\Object\Objectbrick\Data;

use Pimcore\Model\Object;

class Attribute extends Object\Objectbrick\Data\AbstractData  {

public $type = "attribute";
public $val;


/**
* Set val - val
* @return \Pimcore\Model\Object\Data\Block
*/
public function getVal () {
	$data = $this->val;
	if(\Pimcore\Model\Object::doGetInheritedValues($this->getObject()) && $this->getDefinition()->getFieldDefinition("val")->isEmpty($data)) {
		return $this->getValueFromParent("val");
	}
	 return $data;
}

/**
* Set val - val
* @param \Pimcore\Model\Object\Data\Block $val
* @return \Pimcore\Model\Object\Attribute
*/
public function setVal ($val) {
	$this->val = $val;
	return $this;
}

}

