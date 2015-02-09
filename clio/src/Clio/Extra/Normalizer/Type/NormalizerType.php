<?php
namespace Clio\Extra\Normalizer\Type;

use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Type\Type;

class NormalizerType extends Types\ProxyType implements Types\FieldContainable 
{
	private $_type;

	public function getType()
	{
		if(!$this->_type) {
			$baseType = parent::getType();

			if($baseType->isType('shema')) {
				$schema = $baseType->getSchema();
				if($schema && $schema->hasMapping('normalizer')) {
					$this->_type = $schema->getMapping('normalizer')->getType();
				}
			}

			if(!$this->_type) 
				$this->_type = $baseType;
		}

		return $this->_type;
	}

	public function hasFieldType($field) 
	{
		$type = $this->getType();
		if($type instanceof Types\ProxyType) {
			$type = $type->getRawType();
		}

		if($type instanceof FieldContainable) {
			return $type->hasFieldType($field);
		}
		return false;
	}

	public function getFieldType($field) 
	{
		$type = $this->getType();

		if($type instanceof Types\ProxyType) {
			$type = $type->getRawType();
		}

		return $type->getFieldType($field);
	}

	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getType(), $method), $args);
	}

	public function __get($name)
	{
		return $this->getType()->$name;
	}
}

