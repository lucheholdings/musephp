<?php
namespace Clio\Component\Util\Container;

/**
 * Map 
 * 
 * @uses Container
 * @uses 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Map extends Container, \IteratorAggregate, \ArrayAccess
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

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	function getValues();

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
	 * remove
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function remove($key);

	/**
	 * getKeyValueArray
	 * 
	 * @access public
	 * @return void
	 */
	function getKeyValueArray();
}

