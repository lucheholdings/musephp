<?php
namespace Clio\Component\Util\Container;

/**
 * Container 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Container extends \Countable, \IteratorAggregate, \Serializable
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
}

