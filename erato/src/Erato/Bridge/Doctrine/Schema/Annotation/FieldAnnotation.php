<?php
namespace Erato\Bridge\Doctrine\Annotation;

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
     * getFieldName 
     * 
     * @access public
     * @return void
     */
    function getFieldName();

    /**
     * applyField 
     * 
     * @param mixed $fieldConfiguration 
     * @access public
     * @return void
     */
    function applyField($fieldConfiguration);
}

