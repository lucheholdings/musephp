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
     * has 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function has($key);

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
     * getKeyValues 
     * 
     * @access public
     * @return void
     */
    function getKeyValues();

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
     * replace 
     * 
     * @param array $values 
     * @access public
     * @return void
     */
    function replace(array $values);

    /**
     * merge 
     * 
     * @param Map $map 
     * @access public
     * @return void
     */
    function merge(Map $map);
}

