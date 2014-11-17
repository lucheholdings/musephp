<?php
namespace Clio\Component\Util\Tag;

use Clio\Component\Util\Container\Set;

/**
 * TagSet 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagSet extends Set
{
	/**
	 * containsName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function containsName($name);

	/**
	 * getNameArray 
	 * 
	 * @access public
	 * @return void
	 */
	function getNameArray();
}

