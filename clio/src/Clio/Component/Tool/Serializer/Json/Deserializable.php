<?php
namespace Clio\Component\Tool\Serializer\Json;

/**
 * Deserializable 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Deserializable
{
	/**
	 * deserializeJson 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	function deserializeJson($serialized);
}

