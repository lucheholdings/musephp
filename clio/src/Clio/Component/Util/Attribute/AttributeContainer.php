<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Util\Container\Map;

/**
 * AttributeContainer 
 * 
 * @uses Map
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AttributeContainer extends Map
{
	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	function getOwner();

	/**
	 * setOwner 
	 * 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	function setOwner(AttributeContainerAware $owner);
}

