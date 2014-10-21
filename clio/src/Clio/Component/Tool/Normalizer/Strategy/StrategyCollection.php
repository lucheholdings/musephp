<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Exception\UnsupportedException;

/**
 * StrategyCollection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StrategyCollection implements
	NormalizationStrategy,
	DenormalizationStrategy
{
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
	 * @access public
	 * @return void
	 */
	public function addStrategy(Strategy $strategy)
	{
		$this->strategies[] = $strategy;
	}

	/**
	 * normalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function normalize($object, $type = null, Context $context = null)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof NormalizationStrategy) && 
				$strategy->canNormalize($object, $type, $context)) 
			{
				return $strategy->normalize($object, $type, $context);
			}
		}

		throw new UnsupportedException(sprintf('No strategy supports to normalize for type "%s[%s]".', get_class($type), (string)$type));
	}

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canNormalize($object, $type, Context $context)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof NormalizationStrategy) && 
				$strategy->canNormalize($object, $type, $context)) 
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * denormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function denormalize($data, $type, Context $context = null)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof DenormalizationStrategy) && 
				$strategy->canDenormalize($data, $type, $context)) 
			{
				return $strategy->denormalize($data, $type, $context);
			}
		}

		throw new UnsupportedException(sprintf('No strategy supports to normalize for type "%s[%s]".', get_class($type), (string)$type));
	}

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof DenormalizationStrategy) && 
				$strategy->canDenormalize($data, $type, $context)) 
			{
				return true;
			}
		}

		return false;
	}
}

