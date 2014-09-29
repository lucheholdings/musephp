<?php
namespace Clio\Bridge\Doctrine\Metadata\Mapping\Loader;

/**
 * AnnotationLoader 
 * 
 * @uses MappingLoader
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AnnotationLoader implements MappingLoader 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $metadata, AnnotationReaderInterface $annotationReader)
	{
		$this->annotationReader = $annotationReader;
	}

	/**
	 * loadClassMapping 
	 * 
	 * @param ClassMetadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function loadClassMapping($mappingClass)
	{
		$mappings = $this->getAnnotationReader()->getClassAnnotations($this->getClassMetadata(), $mappingClass);
	
		return $mappings;
	}

	/**
	 * loadFieldMapping 
	 * 
	 * @param mixed $field 
	 * @param mixed $mappingClass 
	 * @access public
	 * @return void
	 */
	public function loadFieldMapping($field, $mappingClass)
	{
		$property = $this->getClassMetadata()->getProperty($filed);

		return $this->getAnnotationReader()->getPropertyAnnotation($property, $mappingClass);
	}
}

