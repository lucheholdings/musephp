<?php
namespace Clio\Component\Util\FieldAccessor\Mapping\Factory;

interface MappingFactory
{
	function createClassMapping(\ReflectionClass $reflector);

	function createFieldMapping(ClassMapping $classMapping, $field);
}

