<?php
namespace Clio\Component\Tool\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory;
// Types
use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Types;

/**
 * BasicFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicFactory implements Factory 
{
	public function createType($name, array $options = array())
	{
		switch($name) {
		case Types::TYPE_INT:
		case Types::TYPE_INTEGER:
		case Types::TYPE_STRING:
		case Types::TYPE_FLOAT:
		case Types::TYPE_DOUBLE:
		case Types::TYPE_BOOL:
		case Types::TYPE_BOOLEAN:
			$type = $this->createScalarType($name, $options);
			break;
		case Types::TYPE_MAP:
		case Types::TYPE_ARRAY:
			$type = $this->createMapType($name, $options);
			break;
		case Types::TYPE_SET:
			$type = $this->createSetType($name, $options);
			break;
		case Types::TYPE_NULL:
		case Types::TYPE_IGNORE:
			$type = $this->createNullType($name, $options);
			break;
		case Types::TYPE_MIXED:
			$type = $this->createMixedType($name, $options);
			break;
		default:
			$type = $this->createObjectType($name, $options);
			break;
		}

		$type->setOptions($options);

		return $type;
	}

	protected function createNullType($name, array $options = array())
	{
		return new Type\NullType();
	}

	protected function createMixedType($name, array $options = array())
	{
		return new Type\MixedType();
	}

	protected function createScalarType($name, array $options = array())
	{
		return new Type\ScalarType($name);
	}

	protected function createMapType($name, array $options = array())
	{
		return new Type\MapType();
	}

	protected function createSetType($name, array $options = array())
	{
		return new Type\SetType();
	}

	protected function createObjectType($name, array $options = array())
	{
		if(!class_exists($name)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not exists for normalization type.', $name));
		}

		return new Type\ReflectionClassType(new \ReflectionClass($name));
	}
}

