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
	function toArray();

	function clear();
}

