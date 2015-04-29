<?php
namespace Clio\Component\Util\Container\Storage;

/**
 * SetStorage 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SetStorage 
{
    /**
     * insert 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function insert($value);

    /**
     * exists 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function exists($value);

    /**
     * remove 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function remove($value);
}

