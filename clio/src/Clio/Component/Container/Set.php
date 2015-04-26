<?php
namespace Clio\Component\Container;

/**
 * Set 
 * 
 * @uses Container
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Set extends Container
{
    /**
     * has 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function has($value);

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
    function getValues();

    /**
     * add 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function add($value);

    /**
     * remove 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function remove($value);
}

