<?php
namespace Clio\Component\Pce\FieldAccessor\Mapping\Factory;

interface MappingFactory
{
	function createClassMapping(\ReflectionClass $reflector);

	function createFieldMapping(ClassMapping $classMapping, $field);
}

