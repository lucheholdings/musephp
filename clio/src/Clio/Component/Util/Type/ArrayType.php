<?php
namespace Clio\Component\Util\Type;

class ArrayType extends AbstractType 
{
	public function __construct($name)
	{
		if($name != PrimitiveTypes::TYPE_ARRAY) {
			throw new \InvalidArgumentException(sprintf('Type "%s" is not Scalar value', $name));
		}

		parent::__construct($name);
	}

	public function isType($type)
	{
		switch($type) {
		case PrimitiveTypes::TYPE_ARRAY:
			return true;
		default:
			break;
		}

		return parent::isType($type);
	}

	public function isValidData($value)
	{
		return is_array($value);
	}
}
