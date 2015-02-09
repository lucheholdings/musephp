<?php
namespace Clio\Component\Util\Type;

class ArrayType extends AbstractType 
{
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_ARRAY);
	}

	public function isType($type)
	{
		switch($type) {
		case PrimitiveTypes::TYPE_ARRAY:
			return true;
		default:
			break;
		}

		return false;
	}

	public function isValidData($value)
	{
		return is_array($value);
	}
}
