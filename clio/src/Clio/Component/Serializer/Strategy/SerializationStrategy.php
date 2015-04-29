<?php
namespace Clio\Component\Serializer\Strategy;

use Clio\Component\Serializer\Strategy;

/**
 * SerializationStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SerializationStrategy extends Strategy 
{
	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	function serialize($data, $format = null, $context = null);

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

