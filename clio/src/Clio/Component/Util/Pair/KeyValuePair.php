<?php
namespace Clio\Component\Util\Pair;

/**
 * KeyValuePair 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface KeyValuePair 
{
	/**
	 * setKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function setKey($key);

	/**
	 * getKey 
	 * 
	 * @access public
	 * @return void
	 */
	function getKey();

	/**
	 * setValue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function setValue($value);

	/**
	 * getValue 
	 * 
	 * @access public
	 * @return void
	 */
	function getValue();
}
