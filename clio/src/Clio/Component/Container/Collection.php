<?php
namespace Clio\Component\Container;

/**
 * Collection 
 *   Collection is similar with Map, but also be abled to access with values.
 *   
 * @uses Container
 * @uses 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Collection extends Container, \ArrayAccess
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
     * hasKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function hasKey($key);

    /**
     * getKeys 
     * 
     * @access public
     * @return void
     */
    function getKeys();

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
    function getValues();

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
     * @param mixed $value 
     * @access public
     * @return void
     */
    function remove($value);

    /**
     * removeByKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function removeByKey($key);
}

