<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;
use Clio\Component\Tool\Serializer\Object\JsonSerializable,
	Clio\Component\Tool\Serializer\Object\JsonDeserializable;

use Clio\Component\Tool\Serializer\Exception;

/**
 * JsonSerializableStrategy 
 * 
 * @uses SerializationStrategy
 * @uses DeserializationStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JsonSerializableStrategy implements 
	SerializationStrategy, 
	DeserializationStrategy  
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
		if('json' != $format) {
			throw new Exception\UnsupportedFormatException(sprintf('JsonSerializableStrategy can only serialize "json" format, but "%s" is given.', $format));
		}

		if(!is_object($data) || (!$data instanceof JsonSerializable)) {
			throw new Exception\UnsupportedFormatException(sprintf('JsonSerializableStrategy can only serialize an object implements JsonSeriazable.'));
		}

		return $data->serializeJson();
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
		return (('json' == $format) && ($data instanceof JsonSerializable));
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

		if('json' != $format) {
			throw new Exception\UnsupportedFormatException(sprintf('JsonSerializableStrategy can only deserialize for format "array", but "%s" is given.', $format));
		}

		if(!$refClass->implementsInterface('Clio\Component\Tool\Serializer\Object\JsonDeserializable')) {
			throw new Exception\UnsupportedFormatException('Class "%s" has to be implemented JsonDeserializable to deserialize by JsonSerializableStrategy.');
		}

		$model = $refClass->newInstance();
		$model->deserializeJson($data);

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

		if(('json' == $format) && ($refClass->implementsInterface('Clio\Component\Tool\Serializer\Object\JsonDeserializable'))) {
			return true;
		}

		return false;
	}
}

