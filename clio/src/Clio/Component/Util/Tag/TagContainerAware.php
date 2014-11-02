<?php
namespace Clio\Component\Util\Tag;

/**
 * TagContainerAware 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagContainerAware 
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
	 * @param TagContainer $container 
	 * @access public
	 * @return void
	 */
	function setTagSet(TagContainer $container);
}

