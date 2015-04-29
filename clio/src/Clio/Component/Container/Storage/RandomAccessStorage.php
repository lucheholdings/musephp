<?php
namespace Clio\Component\Container\Storage;

/**
 * RandomAccessStorage 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface RandomAccessStorage 
{
    /**
     * existsAt 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	function existsAt($key);

    /**
     * getAt 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	function getAt($key);

    /**
     * insertAt 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function insertAt($key, $value);

    /**
     * removeAt 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	function removeAt($key);
}
