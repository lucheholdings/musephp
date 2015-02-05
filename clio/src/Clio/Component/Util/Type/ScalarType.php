<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Factory\UnsupportedException;

class ScalarType extends AbstractType 
{
	public function __construct($name)
	{
		switch($name) {
		case PrimitiveTypes::TYPE_ALIAS_INT:
			$name = PrimitiveTypes::TYPE_INTEGER;
			break;
		case PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
			$name = PrimitiveTypes::TYPE_CHAR;
			break;
		case PrimitiveTypes::TYPE_ALIAS_BOOL:
			$name = PrimitiveTypes::TYPE_BOOLEAN;
			break;
		case PrimitiveTypes::TYPE_INTEGER:
		case PrimitiveTypes::TYPE_DOUBLE:
		case PrimitiveTypes::TYPE_FLOAT:
		case PrimitiveTypes::TYPE_CHAR:
		case PrimitiveTypes::TYPE_STRING:
		case PrimitiveTypes::TYPE_BOOLEAN:
			break;
		default:
			throw new UnsupportedException(sprintf('Type "%s" is not Scalar value', $name));
		}
		parent::__construct($name);
	}

	public function isType($type)
	{
		switch($type) {
		case 'scalar':
			return true;
		default:
			return $type == $this->getName();
		}
	}

	public function isValidData($value)
	{
		return is_scalar($value) && ($this->getName() == gettype($value));
	}
}

