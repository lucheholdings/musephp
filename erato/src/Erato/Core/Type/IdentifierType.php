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

	/**
	 * isValidData 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function isValidData($value)
	{
		if(is_scalar($value)) {
			return 1 == count($this->getIdentifierFields());
		} else if(is_array($value)) {
			$ids = $this->getIdentifierFields();
			if(count($ids) == count($value)) {
				foreach($ids as $id) {
					if(!isset($value[$id])) {
						return false;
					}
				}
				return true;
			}
			return false;
		} else {
			return $this->getType()->isValidData($value);
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
		$identifiers = $this->getType()->getIdentifierValues($data);
		if(is_array($identifiers) && count($identifiers)) {
			$identifiers = array_shift($identifiers);
		}

		return $identifiers;
	}
}
