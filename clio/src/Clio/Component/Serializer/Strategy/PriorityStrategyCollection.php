<?php
namespace Clio\Component\Serializer\Strategy;

use Clio\Component\Container\Set\PrioritySet;
use Clio\Component\Serializer\Strategy;
use Clio\Component\Serializer\Context;
use Clio\Component\Exception\UnsupportedException;
use Clio\Component\Validator\SubclassValidator;

/**
 * PriorityStrategyCollection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PriorityStrategyCollection extends PrioritySet implements
	SerializationStrategy,
	DeserializationStrategy
{
	const BEHAVIOR_STRATEGY_PRIORITY   = 100;
	const COMPLEX_STRATEGY_PRIORITY    = 200;
	const CUSTOME_STRATEGY_PRIORITY    = 300;
	const LOW_PRIORITY                 = 100;
	const MID_PRIORITY                 = 300;
	const HIGH_PRIOIRTY                = 500;
	
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer(array());

		$this->setValueValidator(new SubclassValidator('Clio\Component\Serializer\Strategy'));

		foreach($values as $value) {
			$this->add($value);
		}
	}

	/**
	 * addStrategy 
	 * 
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function addStrategy(Strategy $strategy, $priority = self::CUSTOME_STRATEGY_PRIORITY)
	{
		return $this->add($strategy, $priority);
	}

	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null, $context = null)
	{
		foreach($this as $strategy) {
			if( ($strategy instanceof SerializationStrategy) && 
				$strategy->canSerialize($data, $format, $context)) 
			{
				return $strategy->serialize($data, $format, $context);
			}
		}

		throw new UnsupportedException(sprintf('No strategy supports to serialize from "%s" to "%s".', is_object($data) ? get_class($data) : gettype($data), (string)$format));
	}

	/**
	 * canSerialize
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function canSerialize($data, $format = null)
	{
		foreach($this as $strategy) {
			if( ($strategy instanceof SerializationStrategy) && 
				$strategy->canSerialize($data, $format, $context)) 
			{
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
	 * @access public
	 * @return void
	 */
	public function deserialize($data, $type, $format = null, $context = null)
	{
		foreach($this as $strategy) {
			if( ($strategy instanceof DeserializationStrategy) && 
				$strategy->canDeserialize($data, $type, $format, $context)) 
			{
				return $strategy->deserialize($data, $type, $format, $context);
			}
		}

		throw new UnsupportedException(sprintf('No strategy supports to deserialize from "%s" to "%s".', (string)$format, (string)$type));
	}

	/**
	 * canDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function canDeserialize($data, $type, $format = null)
	{
		foreach($this as $strategy) {
			if( ($strategy instanceof DeserializationStrategy) && 
				$strategy->canDeserialize($data, $type, $format, $context)) 
			{
				return true;
			}
		}

		return false;
	}


	public function getSupportFormats()
	{
		$formats = array();

		foreach($this as $strategy) {
			$formats = array_merge($formats, $strategy->getSupportFormats());
		}

		return $formats;
	}
}

