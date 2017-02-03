<?php
namespace Clio\Component\Util\Container;

/**
 * Collection 
 *   Collection is a Container which hybrid the concept of 
 *   Map and MultiSet as php array dose.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Collection extends 
  Container,
  \IteratorAggregate,
  \ArrayAccess
{
	/**
	 * toArray 
	 * 
	 * @access public
	 * @return void
	 */
	function toArray();

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	function clear();

	// Set Functionalities
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

	// AliasedMap Functionalities
	/**
	 * hasKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function hasKey($key);

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $vlaue 
	 * @access public
	 * @return void
	 */
	function set($key, $vlaue);

	/**
	 * getKeys 
	 * 
	 * @access public
	 * @return void
	 */
	function getKeys();

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function get($key);

	/**
	 * removeByKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function removeByKey($key);
}

