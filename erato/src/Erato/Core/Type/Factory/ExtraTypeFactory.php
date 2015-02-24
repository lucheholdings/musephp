<?php
namespace Erato\Core\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Erato\Core\Type;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;
use Clio\Component\Util\Type\NullType;

class ExtraTypeFactory extends AbstractTypeFactory
{
	public function createType($name, array $options = array())
	{
		switch($name) {
		case Type\Types::TYPE_IDENTIFIER:
			return new Type\IdentifierType($options['decorated_type']);
//		case Type\Types::TYPE_IGNORE:
//			return new NullType();
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

	public function isSupportedType($name)
	{
		switch($name) {
		case Type\Types::TYPE_IDENTIFIER:
//		case Type\Types::TYPE_IGNORE:
			return true;
		default:
			return false;
		}
	}
}

