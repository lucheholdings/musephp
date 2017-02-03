<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Exception;
use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;
/**
 * StdClassSerializationStrategy 
 * 
 * @uses SerializationStrategy
 * @uses DeserializationStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StdClassSerializationStrategy extends ArrayCompatibleStrategy implements SerializationStrategy, DeserializationStrategy  
{
	/**
	 * convertToArray 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	protected function convertToArray($data)
	{
		if(!is_object($data) || (!$data instanceof \StdClass)) {
			throw new Exception\UnsupportedFormatException(sprintf('StdClassSerializationStrategy can only serialize an instanceof StdClass.'));
		}

		return (array)$data;
	}

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
		return ('StdClass' == get_class($data)) && parent::canSerialize($data, $format);
	}

	/**
	 * convertFromArray 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access protected
	 * @return void
	 */
	protected function convertFromArray(array $data, $class)
	{
		if('StdClass' != $class) {
			throw new Exception\UnsupportedFormatException(sprintf('StdClassSerializationStrategy can only deserialize to StdClass, but "%s" is specified.', $class));
		}

		return (object) $data;
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
		return ('StdClass' == $class) && parent::canDeserialize($data, $class, $format);
	}
}

