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
	function setAttributeMap(AttributeContainer $attributes);
}
