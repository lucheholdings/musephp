<?php
namespace Calliope\Adapter\Doctrine\Core\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\Metadata,
	Clio\Component\Pce\Metadata\ClassMetadata;
use Calliope\Framework\Core\Metadata\Mapping\Factory\SchemeMappingFactory,
	Calliope\Framework\Core\Metadata\Mapping\SchemeMapping
;
use Doctrine\Common\Annotations\Reader;

// AnnotationMappings
use Calliope\Adapter\Doctrine\Core\Mapping\Builder;

/**
 * AnnotationSchemeMappingFactory 
 * 
 * @uses SchemeMappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AnnotationSchemeMappingFactory extends SchemeMappingFactory 
{
	private $annotationReader;

	/**
	 * __construct 
	 * 
	 * @param Reader $annotationReader 
	 * @access public
	 * @return void
	 */
	public function __construct(Reader $annotationReader)
	{
		$this->annotationReader = $annotationReader;
	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;

		if($metadata instanceof ClassMetadata) {
			$mapping = new SchemeMapping($metadata);

			$reader = $this->getAnnotationReader();
			if($reader) {
				foreach($reader->getClassAnnotations($metadata->getReflectionClass()) as $annotation) {
					$this->doParseMappingAnnotation($mapping, $annotation);
				}
			}
		}

		return $mapping;
	}

	/**
	 * doParseMappingAnnotation 
	 * 
	 * @param mixed $mapping 
	 * @param mixed $annotation 
	 * @access protected
	 * @return void
	 */
	protected function doParseMappingAnnotation($mapping, $annotation)
	{
		if($annotation instanceof Builder) {
			$mapping->setBuilderClass($annotation->getClass());
		}
	}

	public function getAlias()
	{
		return 'calliope_scheme';
	}
    
    /**
     * Get annotationReader.
     *
     * @access public
     * @return annotationReader
     */
    public function getAnnotationReader()
    {
        return $this->annotationReader;
    }
    
    /**
     * Set annotationReader.
     *
     * @access public
     * @param annotationReader the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAnnotationReader($annotationReader)
    {
        $this->annotationReader = $annotationReader;
        return $this;
    }
}

