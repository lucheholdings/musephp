<?php
namespace Erato\Core\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Erato\Core\Type;
use Clio\Component\Pattern\Factory\UnsupportedException;

class ExtraTypeFactory extends AbstractTypeFactory
{
	public function createType($name)
	{
		switch($name) {
		case Type\Types::TYPE_IDENTIFIER:
			return new Type\IdentifierType();
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

	public function isSupportedType($name)
	{
		switch($name) {
		case Type\Types::TYPE_IDENTIFIER:
			return true;
		default:
			return false;
		}
	}
}

