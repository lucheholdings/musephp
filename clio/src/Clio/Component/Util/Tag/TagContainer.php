<?php
namespace Clio\Component\Util\Tag;

/**
 * TagContainer 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagContainer
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

