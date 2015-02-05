<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type;
use Clio\Component\Pattern\Factory\UnsupportedException;

class PrimitiveTypeFactory extends AbstractTypeFactory
{
	public function createType($name)
	{
		switch($name) {
		case Type\PrimitiveTypes::TYPE_NULL:
			return new Type\NullType();
		case Type\PrimitiveTypes::TYPE_MIXED:
			return new Type\MixedType();
		case Type\PrimitiveTypes::TYPE_ALIAS_INT:
		case Type\PrimitiveTypes::TYPE_INTEGER:
		case Type\PrimitiveTypes::TYPE_DOUBLE:
		case Type\PrimitiveTypes::TYPE_FLOAT:
		case Type\PrimitiveTypes::TYPE_CHAR:
		case Type\PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case Type\PrimitiveTypes::TYPE_STRING:
		case Type\PrimitiveTypes::TYPE_ALIAS_BOOL:
		case Type\PrimitiveTypes::TYPE_BOOLEAN:
			return new Type\ScalarType($name);
		case Type\PrimitiveTypes::TYPE_ARRAY:
			return new Type\ArrayType($name);
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

	public function createTypeForValue($value)
	{
		if(is_scalar($value)) {

		} else if(is_array($value)) {
			return $this->doCreateType(Type\PrimitiveTypes::TYPE_ARRAY);
		}
	}

	public function isSupportedType($name)
	{
		switch($name) {
		case Type\PrimitiveTypes::TYPE_NULL:
		case Type\PrimitiveTypes::TYPE_MIXED:
		case Type\PrimitiveTypes::TYPE_ALIAS_INT:
		case Type\PrimitiveTypes::TYPE_INTEGER:
		case Type\PrimitiveTypes::TYPE_DOUBLE:
		case Type\PrimitiveTypes::TYPE_FLOAT:
		case Type\PrimitiveTypes::TYPE_CHAR:
		case Type\PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case Type\PrimitiveTypes::TYPE_STRING:
		case Type\PrimitiveTypes::TYPE_ALIAS_BOOL:
		case Type\PrimitiveTypes::TYPE_BOOLEAN:
		case Type\PrimitiveTypes::TYPE_ARRAY:
			return true;
		default:
			return false;
		}
	}
}

