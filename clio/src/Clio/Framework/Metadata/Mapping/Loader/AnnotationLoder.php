<?php
namespace Clio\Bridge\Doctrine\Metadata\Mapping\Loader;

use Clio\Component\Pce\Metadata\Loader;

class AnnotationLoader extends MappingLoader 
{
	private $annotationReader;

	public function __construct($annotationReader)
	{
		$this->annotationReader = $annotationReader;
	}
    
    public function getAnnotationReader()
    {
        return $this->annotationReader;
    }
    
    public function setAnnotationReader($annotationReader)
    {
        $this->annotationReader = $annotationReader;
        return $this;
    }

	public function loadClassMapping(ClassMetadata $classMetadata)
	{
		// 
		$mapping = $this->doReadClassAnnotation();

		$class = $classMetadata->getReflectionClass();
		foreach($this->getAnnotationReader()->getClassAnnotations($class) as $annotation) {
			$this->invokeAnnotationHandler($annotation, $classMetadata, $class);
		}

		foreach($this->getAnnotationReader()->getPropertyAnnotations($property)) {
			$this->invokeAnnotationHandler($annotation, );
		}
		
		return $mapping;
	}
}

