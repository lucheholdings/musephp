<?php
namespace Clio\Component\Tool\Serializer\Object;

/**
 * JsonDeserializable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface JsonDeserializable 
{
	/**
	 * deserializeJson 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return void
	 */
	function deserializeJson($resource);
}

