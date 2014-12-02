<?php
namespace Clio\Bridge\DoctrineCommon\Metadata\Config;

use Clio\Extra\Metadata\Config\Loader as LoaderInterface;

/**
 * Loader 
 * 
 * @uses AbstractLoader
 * @uses LoaderInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Loader extends AbstractLoader implements LoaderInterface
{
	const CONFIG_SCHEMA = 'schema';

	const CONFIG_FIELD = 'fields';

	/**
	 * {@inheritdoc}
	 */
	protected function doLoad($resource)
	{
		$reflector = new \ReflectionClass($resource);
		$reader = $this->getReader();

		// 
		$configs = array();
		$classAnnotations = $reader->getClassAnnotations($reflector);

		foreach($classAnnotations as $annotation) {
			if($annotation instanceof MappingAnnotation) {
				$configs[self::CONFIG_SCHEMA][] = $annotation;
			}
		}

		foreach($reflector->getProperties() as $property) {
			foreach($reader->getPropertyAnnotations($property) as $annotation) {
				if($annotation instanceof MappingAnnotation) {
					$configs[self::CONFIG_FIELD][$field][] = $annotation;
				}
			}
		}

		foreach($reflector->getMethods() as $method) {
			foreach($reader->getMethodAnnotations($method) as $annotation) {
				if($annotation instanceof SchemaMappingAnnotation) {
					$configs[self::CONFIG_SCHEMA][] = $annotation;
				} else if($annotation instanceof FieldMappingAnnotation) {
					$configs[self::CONFIG_FIELD][$field][] = $annotation;
				}
			}
		}

		return $configs;
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

