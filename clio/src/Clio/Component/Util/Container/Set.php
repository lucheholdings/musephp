<?php
namespace Clio\Component\Util\Container;

/**
 * Set 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Set extends 
  Container,
  \IteratorAggregate
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
	 * getAll
	 *   Get values
	 * @access public
	 * @return void
	 */
	function getValues();

	/**
	 * add
	 * 
	 * @param mixed $vlaue 
	 * @access public
	 * @return void
	 */
	function add($vlaue);

	/**
	 * has
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	function has($value);

	/**
	 * remove
	 * 
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	function remove($value);
}

