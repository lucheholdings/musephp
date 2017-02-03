<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * CompositeStrategy 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CompositeStrategy implements
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
	 * @param NormalizerStrategy $strategy 
	 * @access public
	 * @return void
	 */
	public function addStrategy(NormalizerStrategy $strategy)
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
	public function normalize($object)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof NormalizationStrategy) && 
				$strategy->canNormalize($object)) 
			{
				return $strategy->normalize($object);
			}
		}

		throw new \Clio\Component\Exception\RuntimeException('No strategy supports to normalize.');
	}

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canNormalize($object)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof NormalizationStrategy) && 
				$strategy->canNormalize($object)) 
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
	public function denormalize($data, $class)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof DenormalizationStrategy) && 
				$strategy->canDenormalize($data, $class)) 
			{
				return $strategy->denormalize($data, $class);
			}
		}

		throw new \Clio\Component\Exception\RuntimeException('No strategy supports to denormalize.');
	}

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function canDenormalize($data, $class)
	{
		foreach($this->strategies as $strategy) {
			if( ($strategy instanceof DenormalizationStrategy) && 
				$strategy->canDenormalize($data, $class)) 
			{
				return true;
			}
		}

		return false;
	}
}

