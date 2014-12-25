<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Strategy;

/**
 * DeserializationStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DeserializationStrategy extends Strategy 
{
	/**
	 * deserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function deserialize($data, $class, $format = null, $context = null);

	/**
	 * canDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function canDeserialize($data, $class, $format = null);
}

