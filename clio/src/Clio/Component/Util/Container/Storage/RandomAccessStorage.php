<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

/**
 * RandomAccessStorage 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface RandomAccessStorage extends Storage
{
	/**
	 * setAt 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function setAt($key, $value);

	/**
	 * getAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function getAt($key);

	/**
	 * removeAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function removeAt($key);

	/**
	 * existsAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function existsAt($key);
}

