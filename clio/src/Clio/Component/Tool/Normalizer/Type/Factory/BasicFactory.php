<?php
namespace Clio\Component\Tool\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory;
// Types
use Clio\Component\Tool\Normalizer\Type\PrimitiveType,
	Clio\Component\Tool\Normalizer\Type\ReflectionClassType
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
	public function createType($name)
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
		case 'null':
		case 'mixed':
			return $this->createPrimitiveType($name);
			break;
		default:
			return $this->createObjectType($name);
			break;
		}
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

