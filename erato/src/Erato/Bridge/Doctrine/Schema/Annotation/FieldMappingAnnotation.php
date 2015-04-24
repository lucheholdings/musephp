<?php
namespace Erato\Bridge\Doctrine\Annotation;

/**
 * FieldMappingAnnotation 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FieldMappingAnnotation
{

    /**
     * getFieldName 
     * 
     * @access public
     * @return void
     */
    function getFieldName();

    /**
     * getMappingName 
     * 
     * @access public
     * @return void
     */
    function getMappingName();

    /**
     * applyMapping 
     * 
     * @param mixed $mappingConfiguration 
     * @access public
     * @return void
     */
    function applyMapping($mappingConfiguration);
}

