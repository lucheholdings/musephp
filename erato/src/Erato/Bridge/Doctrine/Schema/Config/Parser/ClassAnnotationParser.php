<?php
namespace Erato\Bridge\Doctrine\Schema\Config\Parser;

use Doctrine\Common\Annotations\Reader,
	Doctrine\Common\Annotations\AnnotationReader
;

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
    public function parse($resource)
    {
        if(!$resource instanceof \ReflectionClass) {
            throw new \InvalidArgumentException('AnnotationParser only accept an instanceof ReflectionClass.');
        }

        // get ClassAnnotation to configure Schema
        $configuration = new Configuration();

        $this->parseClassAnnotation($resource, $configuration);

        foreach($resource->getProperties() as $property) {
            $this->parsePropertyAnnotation($proeprty, $configuration);
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
        foreach($this->getAnnotationReader()->getClassAnnotations($class, $configuration) as $annot) {
            $annot->setReflector($class);
            $this->apply($configuration, $annot);
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
        foreach($this->getAnnotationReader()->getPropertyAnnotations($property, $configuration) as $annot) {
            $annot->setReflector($property);
            $this->apply($configuration, $annot);
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
            $annot->setReflector($method);
            $this->apply($configuration, $annot);
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
    protected function apply($configuration, $annot)
    {
        if($annot instanceof Annotation\SchemaAnnotation) {
            $annot->applySchema($configuration);
        } 

        if($annot instanceof Annotation\FieldAnnotation) {
            $annot->applyField($configuration->getField($annot->getFieldName()));
        }

        if($annot instanceof Annotation\SchemaMappingAnnotation) {
            $annot->applyMapping($configuration->getMapping($annot->getMappingName()));
        }

        if($annot instanceof Annotation\FieldMappingAnnotation) {
            $annot->applyMapping($configuration->getField($annot->getFieldName())->getMapping($annot->getMappingName()));
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

