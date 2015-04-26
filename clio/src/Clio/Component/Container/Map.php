<?php
namespace Clio\Component\Container;

/**
 * Map 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Map extends Container, \ArrayAccess
{
    /**
     * get 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function get($key);

    /**
     * set 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function set($key, $value);

    /**
     * remove 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function remove($key);

    /**
     * has 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function has($key);

    function clear();

    /**
     * merge 
     * 
     * @param Map $map 
     * @access public
     * @return void
     */
    function merge(Map $map);
}

