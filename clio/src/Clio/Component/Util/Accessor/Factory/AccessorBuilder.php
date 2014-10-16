<?php
namespace Clio\Component\Util\Accessor\Factory;

class AccessorFactory 
{
	public function createAccessor($target, $scheme = null)
	{
		if(is_array($target)) {
			// ArrayAccessor
			if($scheme) {
				return new ArraySchemeAccessor($target, $scheme);
			} else { 
				// Basic Accessor
				return new ArrayAccessor($target, $schemeAccessor);
			}
		} else if(is_object($target)) {
			if($target instanceof \ReflectionClass) {
				return $this->createSchemaAccessor($target, $schema);
			} else {
				$schemaAccessor = $this->createSchemaAccessor(new \ReflectionClass($target), $schema);
				return new ObjectAccessor($schemaAccessor, $target);
			}
		}
	}

	public function createSchemaAccessor(\ReflectionClass $classReflector, $schema)
	{

		if(!$schema) {
			// Create Schema for Class
			$schema = $this->getSchemeFactory()->createSchemeForClass($classReflector);
		}
		// create ClassAccessor
		$factory = $this->getFieldAccessorFactory();
		
		// For each field, create the field Accessor
	}

	public function getFieldAccessorFactory()
	{
		if(!$this->fieldAccessorFactory) {
			$this->fieldAccessorFactory = new BasicFieldAccessorFactory();
		}
		return $this->fieldAccessorFactory;
	}

	public function setFieldAccessorFactory(FieldAccessorFactory $factory)
	{
		$this->fieldAccessorFactory = $factory;
		return $this;
	}
}

