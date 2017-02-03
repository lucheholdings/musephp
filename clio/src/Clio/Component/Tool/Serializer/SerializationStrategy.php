<?php
namespace Clio\Component\Tool\Serializer;

/**
 * SerializationStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SerializationStrategy extends SerializerStrategy 
{
	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function serialize($data, $format = null);

	/**
	 * canSerialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function canSerialize($data, $format = null);
}

