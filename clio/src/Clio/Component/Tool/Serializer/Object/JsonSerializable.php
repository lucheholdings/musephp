<?php
namespace Clio\Component\Tool\Serializer\Object;

/**
 * JsonSerializable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface JsonSerializable 
{
	/**
	 * serializeJson 
	 * 
	 * @access public
	 * @return void
	 */
	function serializeJson();
}

