<?php
namespace Clio\Component\Util\Tag;

/**
 * TagFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagFactory 
{
	/**
	 * createTag 
	 * 
	 * @param mixed $name 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	function createTag($name, $owner = null);
}

