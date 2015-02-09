<?php
namespace Clio\Extra\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Clio\Extra\Type;
use Clio\Component\Pattern\Factory\UnsupportedException;

class TypeFactory extends AbstractTypeFactory
{
	public function createType($name)
	{
		switch($name) {
		case Type\Types::TYPE_SET:
		case Type\Types::TYPE_LIST:
			return new Type\SetType();
		case Type\Types::TYPE_MAP:
			return new Type\MapType();
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

	public function isSupportedType($name)
	{
		switch($name) {
		case Type\Types::TYPE_SET:
		case Type\Types::TYPE_MAP:
		case Type\Types::TYPE_LIST:
			return true;
		default:
			return false;
		}
	}
}

