<?php
namespace Clio\Component\Util\Tag;

/**
 * TagSet 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagSet
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

