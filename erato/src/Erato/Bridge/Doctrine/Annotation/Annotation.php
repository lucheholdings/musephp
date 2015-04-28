<?php
namespace Erato\Bridge\Doctrine\Annotation;

/**
 * Annotation
 *    Annotation interface  
 * @uses Annotation
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Annotation
{
    /**
     * getReflector 
     * 
     * @access public
     * @return void
     */
    function getReflector();
    
    /**
     * setReflector 
     * 
     * @param \Reflector $reflector 
     * @access public
     * @return void
     */
    function setReflector(\Reflector $reflector);
}

