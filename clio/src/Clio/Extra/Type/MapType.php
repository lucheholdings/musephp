<?php
namespace Clio\Extra\Type;

use Clio\Component\Util\Type\AbstractType;
use Clio\Component\Util\Type\Actual\ArrayType;
/**
 * MapType 
 * 
 * @uses ArrayType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MapType extends ArrayType 
{
	public function __construct()
	{
		AbstractType::__construct(Types::TYPE_MAP);
	}

	public function isType($type)
	{
		switch($type) {
		case Types::TYPE_MAP:
			return true;
		default:
			return parent::isType($type);
			break;
		}

		return false;
	}

	public function isValidData($value)
	{
		return is_array($value) || (($value instanceof \ArrayAccess) && ($value instanceof \Traversable));
	}
}
