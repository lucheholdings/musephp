<?php
namespace Clio\Extra\Type;

use Clio\Component\Util\Type\AbstractType;
use Clio\Component\Util\Type\Actual\ArrayType;
/**
 * SetType 
 * 
 * @uses ArrayType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SetType extends ArrayType 
{
	public function __construct()
	{
		AbstractType::__construct(Types::TYPE_SET);
	}

	public function isType($type)
	{
		switch($type) {
		case Types::TYPE_SET:
		case Types::TYPE_LIST:
			return true;
		default:
			return parent::isType($type);
			break;
		}
	}

	public function isValidData($value)
	{
		return is_array($value) || (($value instanceof \ArrayAccess) && ($value instanceof \Traversable));
	}
}
