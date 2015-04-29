<?php
namespace Clio\Component\Serializer\Strategy;

use Clio\Component\Serializer\Context;
use Clio\Component\Serializer\Json\Serializable as JsonSerializable,
	Clio\Component\Serializer\Json\Deserializable as JsonDeserializable;

/**
 * JsonSerializableStrategy 
 * 
 * @uses AbstractStrategy
 * @uses SerializationStrategy
 * @uses DeserializationStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class JsonSerializableStrategy extends AbstractStrategy implements SerializationStrategy, DeserializationStrategy
{
	/**
	 * doSerialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @param Context $context 
	 * @access protected
	 * @return void
	 */
	protected function doSerialize($data, $format, Context $context)
	{
		if(($format === 'json') && ($data instanceof JsonSerializable)) {
			return $data->serializeJson();
		}

		throw new \InvalidArgumentException(sprintf('JsonSerializableStrategy only support an instance of JsonSerializable with json format.'));
	}

	/**
	 * doDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @param Context $context 
	 * @access protected
	 * @return void
	 */
	protected function doDeserialize($data, $type, $format, Context $context)
	{
		if(($format === 'json') && ($data instanceof JsonDeserializable)) {
			return $data->deserializeJson($data);
		}

		throw new \InvalidArgumentException(sprintf('JsonSerializableStrategy only support an instance of JsonDeserializable'));
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
		if(!is_object($data)) 
			return false;
		$dataReflector = new \ReflectionClass($data);

		return ($format === 'json') && ($dataReflector->implementsInterface('Clio\Component\Serializer\Json\Serializable'));
	}

	/**
	 * canDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canDeserialize($data, $type, $format = null)
	{
		$typeReflector = new \ReflectionClass($type);

		return ($format === 'json') && ($typeReflector->implementsInterface('Clio\Component\Serializer\Json\Deserializable'));
	}

	/**
	 * getSupportFormats 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSupportFormats()
	{
		return array('json');
	}
}

