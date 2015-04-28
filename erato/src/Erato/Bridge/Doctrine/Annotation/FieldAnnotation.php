<?php
namespace Erato\Bridge\Doctrine\Annotation;

use Erato\Core\Schema\Config\SchemaConfiguration;
/**
 * FieldAnnotation 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FieldAnnotation
{
    /**
     * applyField 
     * 
     * @param mixed $fieldConfiguration 
     * @access public
     * @return void
     */
    function applyField(SchemaConfiguration $configuration);
}

