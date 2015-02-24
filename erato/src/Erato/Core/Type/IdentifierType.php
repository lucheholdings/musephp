<?php
namespace Erato\Core\Type;

use Clio\Component\Util\Type\ProxyType;
use Clio\Component\Tool\Normalizer\Type\Types as NormalizerTypes;

/**
 * IdentifierType 
 * 
 * @uses ProxyType 
 * @uses ReferenableType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class IdentifierType extends ProxyType 
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
		case Types::TYPE_IDENTIFIER:
		case NormalizerTypes::TYPE_REFERENCE:
			return true;
		default:
			return $this->getType()->isType($type);
			break;
		}
	}

	///**
	// * isValidData 
	// * 
	// * @param mixed $value 
	// * @access public
	// * @return void
	// */
	//public function isValidData($value)
	//{
	//	return is_array($value) && $this->getIdentifierMapping()->validateValues($value); 
	//}

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
