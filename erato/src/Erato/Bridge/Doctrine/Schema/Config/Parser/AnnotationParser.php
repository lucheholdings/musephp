<?php
namespace Erato\Bridge\Doctrine\Schema\Config\Parser;

use Doctrine\Common\Annotations\Reader,
	Doctrine\Common\Annotations\AnnotationReader
;

use Erato\Core\Schema\Config\Parser;
use Erato\Core\Schema\Config\SchemaConfiguration;
use Erato\Core\Schema\Config\FieldConfiguration;
use Erato\Bridge\Doctrine\Annotation;
/**
 * AnnotationParser 
 * 
 * @uses Parser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AnnotationParser implements Parser 
{
    /**
     * annotationReader 
     * 
     * @var mixed
     * @access private
     */
    private $annotationReader;

    public function __construct(Reader $reader = null)
    {
        if(!$reader) {
            $reader = new AnnotationReader();
        }
        $this->annotationReader = $reader;
    }

    /**
     * parse 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function parse($resource = null)
    {
        if(!$resource instanceof \ReflectionClass) {
            throw new \InvalidArgumentException('AnnotationParser only accept an instanceof ReflectionClass.');
        }

        // get ClassAnnotation to configure Schema
        $configuration = new SchemaConfiguration();

        $this->parseClassAnnotation($resource, $configuration);

        foreach($resource->getProperties() as $property) {
            $this->parsePropertyAnnotation($property, $configuration);
        }

        foreach($resource->getMethods() as $method) {
            $this->parseMethodAnnotation($method, $configuration);
        }

        return $configuration;
    }

    /**
     * parseClassAnnotation 
     * 
     * @access protected
     * @return void
     */
    protected function parseClassAnnotation($class, $configuration)
    {
        foreach($this->getAnnotationReader()->getClassAnnotations($class) as $annot) {
            $this->apply($configuration, $class, $annot);
        }
    }

    /**
     * parsePropertyAnnotation 
     * 
     * @access protected
     * @return void
     */
    protected function parsePropertyAnnotation($property, $configuration)
    {
        foreach($this->getAnnotationReader()->getPropertyAnnotations($property) as $annot) {
            $this->apply($configuration, $property, $annot);
        }
    }

    /**
     * parseMethodAnnotation 
     * 
     * @access protected
     * @return void
     */
    protected function parseMethodAnnotation($method, $configuration)
    {
        foreach($this->getAnnotationReader()->getMethodAnnotations($method) as $annot) {
            $this->apply($configuration, $method, $annot);
        }
    }

    /**
     * apply 
     * 
     * @param mixed $configuration 
     * @param mixed $annot 
     * @access protected
     * @return void
     */
    protected function apply($configuration, \Reflector $reflector, $annot)
    {
        if($annot instanceof Annotation\Annotation) {
           $annot->setReflector($reflector);
        }

        if($annot instanceof Annotation\SchemaAnnotation) {
            $annot->applySchema($configuration);
        } 

        if($annot instanceof Annotation\FieldAnnotation) {
            $annot->applyField($configuration);
        }

        if($annot instanceof Annotation\MappingAnnotation) {
            $annot->applyMapping($configuration);
        }

        return $configuration;
    }
    
    /**
     * getAnnotationReader 
     * 
     * @access public
     * @return void
     */
    public function getAnnotationReader()
    {
        return $this->annotationReader;
    }
    
    /**
     * setAnnotationReader 
     * 
     * @param mixed $annotationReader 
     * @access public
     * @return void
     */
    public function setAnnotationReader(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
        return $this;
    }
}

