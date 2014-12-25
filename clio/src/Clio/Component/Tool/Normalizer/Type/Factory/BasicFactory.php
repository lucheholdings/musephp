<?php
namespace Clio\Component\Tool\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory;
// Types
use Clio\Component\Tool\Normalizer\Type\PrimitiveType,
	Clio\Component\Tool\Normalizer\Type\ReflectionClassType,
	Clio\Component\Tool\Normalizer\Type\MixedType,
	Clio\Component\Tool\Normalizer\Type\NullType
;

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
		case 'int':
		case 'integer':
		case 'string':
		case 'float':
		case 'double':
		case 'bool':
		case 'boolean':
		case 'array':
			$type = $this->createPrimitiveType($name);
			break;
		case 'null':
		case 'ignore':
			$type = $this->createNullType($name);
			break;
		case 'mixed':
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
		return new NullType();
	}

	protected function createMixedType()
	{
		return new MixedType();
	}

	protected function createPrimitiveType($name)
	{
		return new PrimitiveType($name);
	}

	protected function createObjectType($name)
	{
		if(!class_exists($name)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not exists for normalization type.', $name));
		}

		return new ReflectionClassType(new \ReflectionClass($name));
	}
}

