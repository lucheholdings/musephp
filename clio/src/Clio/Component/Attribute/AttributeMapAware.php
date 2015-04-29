<?php
namespace Clio\Component\Attribute;

/**
 * AttributeMapInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface AttributeMapAware
{
	/**
	 * getAttributeMap 
	 * 
	 * @access public
	 * @return void
	 */
	function getAttributeMap();

	/**
	 * setAttributeMap 
	 * 
	 * @param mixed $attributes 
	 * @access public
	 * @return void
	 */
	function setAttributeMap(AttributeMap $attributes);
}
