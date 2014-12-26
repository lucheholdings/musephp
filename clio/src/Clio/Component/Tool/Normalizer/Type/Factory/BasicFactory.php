<?php
namespace Clio\Component\Tool\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory;
// Types
use Clio\Component\Tool\Normalizer\Type;

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
		case Type::TYPE_INT:
		case Type::TYPE_INTEGER:
		case Type::TYPE_STRING:
		case Type::TYPE_FLOAT:
		case Type::TYPE_DOUBLE:
		case Type::TYPE_BOOL:
		case Type::TYPE_BOOLEAN:
			$type = $this->createScalarType($name);
			break;
		case Type::TYPE_ARRAY:
			$type = $this->createArrayType();
			break;
		case Type::TYPE_NULL:
		case Type::TYPE_IGNORE:
			$type = $this->createNullType($name);
			break;
		case Type::TYPE_MIXED:
			$type = $this->createMixedType();
			break;
		default:
			$type = $this->createObjectType($name);
			break;
		}

		$type->setOptions($options);

		return $type;
	}

	protected function createNullType()
	{
		return new Type\NullType();
	}

	protected function createMixedType()
	{
		return new Type\MixedType();
	}

	protected function createScalarType($name)
	{
		return new Type\ScalarType($name);
	}

	protected function createArrayType()
	{
		return new Type\ArrayType();
	}

	protected function createObjectType($name)
	{
		if(!class_exists($name)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not exists for normalization type.', $name));
		}

		return new Type\ReflectionClassType(new \ReflectionClass($name));
	}
}

