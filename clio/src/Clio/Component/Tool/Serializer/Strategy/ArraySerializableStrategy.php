<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Object\ArraySerializable,
	Clio\Component\Tool\Serializer\Object\ArrayDeserializable;

use Clio\Component\Tool\Serializer\Exception;
use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;

/**
 * ArraySerializableStrategy 
 * 
 * @uses SerializationStrategy
 * @uses DeserializationStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArraySerializableStrategy implements SerializationStrategy, DeserializationStrategy  
{
	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null)
	{
		if('array' != $format) {
			throw new Exception\UnsupportedFormatException(sprintf('ArraySerializableStrategy can only serialize "array" format, but "%s" is given.', $format));
		}

		if(!is_object($data) || (!$data instanceof ArraySerializable)) {
			throw new Exception\UnsupportedFormatException(sprintf('ArraySerializableStrategy can only serialize an object implements ArraySerializable.'));
		}

		return $data->serializeArray();
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
		return (('array' == $format) && ($data instanceof ArraySerializable));
	}

	/**
	 * deserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function deserialize($data, $class, $format = null)
	{
		$refClass = new \ReflectionClass($class);

		if('array' != $format) {
			throw new Exception\UnsupportedFormatException(sprintf('ArraySerializableStrategy can only deserialize for format "array", but "%s" is given.', $format));
		}

		if(!$refClass->implementsInterface('Clio\Component\Tool\Serializer\Object\ArrayDeserializable')) {
			throw new Exception\UnsupportedFormatException('Class "%s" has to be implemented ArrayDeserializable to deserialize by ArraySerializableStrategy.');
		}

		$model = $refClass->newInstance();
		$model->deserializeArray($data);

		return $model;
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
		$refClass = new \ReflectionClass($class);

		if(('array' == $format) && ($refClass->implementsInterface('Clio\Component\Tool\Serializer\Object\ArrayDeserializable'))) {
			return true;
		}

		return false;
	}
}

