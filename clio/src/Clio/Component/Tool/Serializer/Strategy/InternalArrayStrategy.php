<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;
/**
 * InternalArrayStrategy 
 * 
 * @uses ArrayCompatibleStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InternalArrayStrategy extends ArrayCompatibleStrategy implements SerializationStrategy, DeserializationStrategy 
{
	/**
	 * canSerialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canSerialize($data, $format = null) 
	{
		return is_array($data) && parent::canSerialize($data, $format);
	}

	/**
	 * convertFromArray 
	 * 
	 * @param array $data 
	 * @param mixed $class 
	 * @access protected
	 * @return void
	 */
	protected function convertFromArray(array $data, $class) 
	{
		return $data;
	}

	/**
	 * convertToArray 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function convertToArray($data)
	{
		return $data;
	}

	/**
	 * canDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canDeserialize($data, $class, $format = null)
	{
		return is_array($data) && ('array' == $class) && parent::canDeserialize($data, $class, $format);
	}
}

