<?php
namespace Erato\Bridge\Doctrine\Annotation;

/**
 * SchemaAnnotation 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SchemaAnnotation
{
    /**
     * applySchema 
     * 
     * @param mixed $configuration 
     * @access public
     * @return void
     */
    function applySchema($configuration);
}

