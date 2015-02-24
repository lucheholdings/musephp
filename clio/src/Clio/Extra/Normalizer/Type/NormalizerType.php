<?php
namespace Clio\Extra\Normalizer\Type;

use Clio\Component\Util\Type as Types;
use Clio\Component\Util\Type\Type;

class NormalizerType extends Types\ProxyType implements Types\FieldContainable 
{
	private $_type;

	//public function getType()
	//{
	//	//return parent::getType();
	//	//if(!$this->_type) {
	//	//	$baseType = parent::getType();
	//	//	//if($baseType->isType('schema')) {
	//	//	//	$schema = $baseType->getSchema();
	//	//	//	if($schema && $schema->hasMapping('normalizer')) {
	//	//	//		$this->_type = $schema->getMapping('normalizer')->getType();
	//	//	//	}
	//	//	//}

	//	//	if(!$this->_type) 
	//	//		$this->_type = $baseType;
	//	//}
	//	//return $this->_type;
	//}

	public function hasFieldType($field) 
	{
		$type = $this->getType();
		if($type instanceof Types\ProxyType) {
			$type = $type->getRawType();
		}

		if($type instanceof Types\FieldContainable) {
			return $type->hasFieldType($field);
		} else if($type->isType('array')) {
			return true;
		}
		return false;
	}

	public function getFieldType($fieldName) 
	{
		$type = $this->getType();

		// Get type from field normalizer mapping
		if($type->isType('schema')) {
			$schema = $type->getSchema();
			$field = $schema->getField($fieldName);

			if($field->hasMapping('normalizer')) {
				$fieldType = $field->getMapping('normalizer')->getType();

			} else {
				$fieldType = $field->getType();
			}
		} else if($type instanceof Types\FieldContainable){
			$fieldType = $type->getFieldType($fieldName);
		} else {
			// first type to get from "fields" option
			$fields = $type->options->get('fields', array());
			if(isset($fields[$fieldName])) {
				$fieldType = $fields[$fieldName];
			} else {
				$fieldType = $type->options->get('field_type', 'mixed');
			}
		}
	
		if(!$fieldType instanceof Types\FieldType) {
			$fieldType = new Types\FieldType($fieldType);
		}
		return $fieldType;
	}

	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getType(), $method), $args);
	}

	public function __get($name)
	{
		//return parent::getType()->$name;
		return $this->getType()->$name;
	}
}

