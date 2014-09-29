<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\SerializerStrategy;
use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;

/**
 * CompositeStrategy 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CompositeStrategy implements SerializationStrategy, DeserializationStrategy 
{
	/**
	 * strategies 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $strategies = array();

	public function __construct(array $strategies = array())
	{
		foreach($strategies as $strategy) {
			$this->addStrategy($strategy);
		}
	}

	/**
	 * addStrategy 
	 * 
	 * @param Strategy $strategy 
	 * @access protected
	 * @return void
	 */
	protected function addStrategy(SerializerStrategy $strategy)
	{
		$this->strategies[] = $strategy;
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
		foreach($this->strategies as $strategy) {
			if(($strategy instanceof SerializationStrategy) && $strategy->canSerialize($data, $format)) {
				return $strategy->serialize($data, $format);
			}
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Strategy dose not support to serialize data "%s" with format "%s".', is_object($data) ? get_class($data) : gettype($data), $format));
	}

	/**
	 * isSupportSerialization 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canSerialize($data, $format = null)
	{
		foreach($this->strategies as $strategy) {
			if(($strategy instanceof SerializationStrategy) && $strategy->canSerialize($data, $format)) {
				return true;
			}
		}

		return false;
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
		foreach($this->strategies as $strategy) {

			if(($strategy instanceof DeserializationStrategy) && $strategy->canDeserialize($data, $class, $format)) {
				return $strategy->deserialize($data, $class, $format);
			}
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Strategy dose not support to deserialize data "%s" with format "%s".', is_object($data) ? get_class($data) : gettype($data), $format));
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
		foreach($this->strategies as $strategy) {
			if(($strategy instanceof DeserializationStrategy) && $strategy->canDeserialize($data, $class, $format)) {
				return true;
			}
		}
		
		return false;
	}
}

