<?php
namespace Erato\Bridge\DoctrineCommon\Metadata\Config\Loader;

use Clio\Bridge\DoctrineCommon\Loader\AnnotationLoader as BaseLoader;
use Erato\Core\Metadata\Config\Loader as ConfigLoader;
use Erato\Bridge\DoctrineCommon\Metadata\Config\ConfigurationBuilder;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\MappingAnnotation,
	Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation,
	Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation
;

class AnnotationLoader extends BaseLoader implements ConfigLoader 
{
	const CONFIG_SCHEMA = 'schema';

	const CONFIG_FIELD = 'fields';

	/**
	 * {@inheritdoc}
	 */
	protected function doLoad(\ReflectionClass $reflector)
	{
		$reader = $this->getReader();
		$builder = new ConfigurationBuilder();
		// 
		$configs = array();
		$classAnnotations = $reader->getClassAnnotations($reflector);

		foreach($classAnnotations as $annotation) {
			if($annotation instanceof MappingAnnotation) {
				$builder->addSchemaAnnotation($annotation);
			}
		}

		foreach($reflector->getProperties() as $property) {
			foreach($reader->getPropertyAnnotations($property) as $annotation) {
				if($annotation instanceof MappingAnnotation) {
					$builder->addFieldAnnotation($property->getName(), $annotation);
				}
			}
		}

		foreach($reflector->getMethods() as $method) {
			foreach($reader->getMethodAnnotations($method) as $annotation) {
				if($annotation instanceof SchemaMappingAnnotation) {
					$builder->addSchemaAnnotation($annotation);
				} else if($annotation instanceof FieldMappingAnnotation) {
					$builder->addFieldAnnotation($annotation->getName(), $annotation);
				}
			}
		}

		return $builder->build();
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($resource)
	{
		if(!class_exists($resource)) {
			return false;
		}

		return true;
	}
}

