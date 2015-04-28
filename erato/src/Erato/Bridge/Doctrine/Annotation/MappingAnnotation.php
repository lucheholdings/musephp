<?php
namespace Erato\Bridge\Doctrine\Annotation;

use Erato\Core\Schema\Config\SchemaConfiguration;
/**
 * MappingAnnotation 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface MappingAnnotation
{
    /**
     * applyMapping 
     * 
     * @param mixed $mappingConfiguration 
     * @access public
     * @return void
     */
    function applyMapping(SchemaConfiguration $configuration);
}

