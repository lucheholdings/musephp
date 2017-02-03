<?php
namespace Clio\Component\Tool\Serializer\Object;

/**
 * ArrayDeserializable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ArrayDeserializable 
{
	/**
	 * deserializeArray 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return void
	 */
	function deserializeArray(array $resource);
}

