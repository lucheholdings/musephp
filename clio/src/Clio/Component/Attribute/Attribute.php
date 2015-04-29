<?php
namespace Clio\Component\Attribute;

use Clio\Component\Pair\KeyValuePair;

/**
 * Attribute 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface Attribute extends KeyValuePair 
{
	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	function getOwner();
}
