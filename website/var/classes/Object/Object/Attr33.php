<?php 

namespace Pimcore\Model\Object\Object;

class Attr33 extends \Pimcore\Model\Object\Objectbrick {



protected $brickGetters = array('attribute');


public $attribute = null;

/**
* @return \Pimcore\Model\Object\Objectbrick\Data\attribute
*/
public function getAttribute() { 
   return $this->attribute; 
}

/**
* @param \Pimcore\Model\Object\Objectbrick\Data\attribute $attribute
* @return void
*/
public function setAttribute ($attribute) {
	$this->attribute = $attribute;
	return $this;;
}

}

