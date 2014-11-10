<?php
namespace Clio\Component\Util\Tag;

/**
 * TagSetAware 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagSetAware 
{
	/**
	 * getTags 
	 * 
	 * @access public
	 * @return void
	 */
	function getTagSet();

	/**
	 * setTags 
	 * 
	 * @param TagSet $container 
	 * @access public
	 * @return void
	 */
	function setTagSet(TagSet $container);
}

