<?php
namespace Clio\Component\Util\Attribute;

/**
 * AttributeContainerInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface AttributeContainerAware
{
	/**
	 * getAttributes 
	 * 
	 * @access public
	 * @return void
	 */
	function getAttributes();

	/**
	 * setAttributes 
	 * 
	 * @param mixed $attributes 
	 * @access public
	 * @return void
	 */
	function setAttributes(AttributeContainer $attributes);
}
