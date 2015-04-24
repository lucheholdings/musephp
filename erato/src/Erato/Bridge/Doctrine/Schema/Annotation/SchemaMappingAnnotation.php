<?php
namespace Erato\Bridge\Doctrine\Annotation;

/**
 * SchemaMappingAnnotation 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SchemaMappingAnnotation
{
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
     * @access public
     * @return void
     */
    function applyMapping($mappingConfiguration);
}

