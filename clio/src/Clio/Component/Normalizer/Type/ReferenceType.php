<?php
namespace Clio\Component\Normalizer\Type;

use Clio\Component\Type\ProxyType;

/**
 * ReferenceType 
 * 
 * @uses ProxyType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ReferenceType extends ProxyType 
{
	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isType($type)
	{
		switch($type) {
		case Types::TYPE_REFERENCE:
			return true;
		default:
			return parent::isType($type);
		}
	}

	/**
	 * getIdentifierFields 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIdentifierFields()
	{
		return $this->getType()->getIdentifierFields();
	}

	/**
	 * getIdentifierValues 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function getIdentifierValues($data)
	{
		return $this->getType()->getIdentifierValues($data);
	}
}

