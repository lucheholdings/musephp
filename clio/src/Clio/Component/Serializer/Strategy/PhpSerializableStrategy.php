<?php
namespace Clio\Component\Serializer\Strategy;

use Clio\Component\Serializer\Context;

/**
 * PhpSerializableStrategy 
 * 
 * @uses AbstractStrategy
 * @uses SerializationStrategy
 * @uses DeserializationStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PhpSerializableStrategy extends AbstractStrategy implements SerializationStrategy, DeserializationStrategy
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
		if(($format === 'php') && ($data instanceof Serializable)) {
			return serialize($data);
		}

		throw new \InvalidArgumentException(sprintf('PhpSerializableStrategy only support an instance of Serializable with php format.'));
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
		if(($format === 'php') && ($data instanceof Serializable)) {
			return unserialize($data);
		}

		throw new \InvalidArgumentException(sprintf('PhpSerializableStrategy only support an instance of Serializable'));
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

		return ($format === 'php') && ($dataReflection->implementsInterface('\Serializable'));
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
		$typeReflection = new \ReflectionClass($type);

		return ($format === 'php') && ($typeReflection->implementsInterface('\Serializable'));
	}

	/**
	 * getSupportFormats 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSupportFormats()
	{
		return array('php');
	}
}

