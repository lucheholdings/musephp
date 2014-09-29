<?php
namespace Clio\Component\Tool\Serializer;

/**
 * Serializer 
 * 
 * @uses SerializerInterface
 * @uses DeserializerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Serializer implements 
	SerializationStrategy, 
	DeserializationStrategy
{
	public function __construct(SerializerStrategy $strategy)
	{
		$this->strategy = $strategy;
	}

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
		if(!$this->strategy instanceof SerializationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Strategy dose not support serialize.');
		}
		return $this->strategy->serialize($data, $format);
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
		return $this->strategy->canSerialize($data, $format);
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
		if(!$this->strategy instanceof DeserializationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Strategy dose not support deserialize.');
		}
		return $this->strategy->deserialize($data, $class, $format);
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
		return $this->strategy->canDeserialize($data, $class, $format);
	}
}

