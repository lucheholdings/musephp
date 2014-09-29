<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

/**
 * DirectionalStorage 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DirectionalStorage extends Storage
{
	/**
	 * addFirst 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function addFirst($value);

	/**
	 * addLast 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function addLast($value);

	/**
	 * removeFirst 
	 * 
	 * @access public
	 * @return void
	 */
	function removeFirst();

	/**
	 * removeLast 
	 * 
	 * @access public
	 * @return void
	 */
	function removeLast();

	/**
	 * first 
	 * 
	 * @access public
	 * @return void
	 */
	function first();

	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	function last();

}

