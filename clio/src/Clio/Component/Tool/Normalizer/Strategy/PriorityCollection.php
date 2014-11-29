<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Util\Container\Set\PrioritySet;
use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Exception\UnsupportedException;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * PriorityCollection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PriorityCollection extends PrioritySet implements
	NormalizationStrategy,
	DenormalizationStrategy
{
	const COMPLEX_STRATEGY_PRIORITY    = 300;
	const BEHAVIOR_STRATEGY_PRIORITY   = 100;
	const CUSTOME_STRATEGY_PRIORITY    = 500;
	
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer(array());

		$this->setValueValidator(new SubclassValidator('Clio\Component\Tool\Normalizer\Strategy'));

		foreach($values as $value) {
			$this->add($value);
		}
	}

	public function initDefaultStrategies()
	{
		$this->clear();
		$this
			->addStrategy(new ScalarStrategy(),    self::BEHAVIOR_STRATEGY_PRIORITY)
			->addStrategy(new ReferenceStrategy(), self::COMPLEX_STRATEGY_PRIORITY)
			->addStrategy(new StdClassStrategy(),  self::COMPLEX_STRATEGY_PRIORITY)
			->addStrategy(new DateTimeStrategy(),  self::COMPLEX_STRATEGY_PRIORITY)
		;

		return $this;
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
	 * normalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function normalize($object, $type = null, Context $context = null)
	{
		foreach($this as $strategy) {
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
		foreach($this as $strategy) {
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
		foreach($this as $strategy) {
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
		foreach($this as $strategy) {
			if( ($strategy instanceof DenormalizationStrategy) && 
				$strategy->canDenormalize($data, $type, $context)) 
			{
				return true;
			}
		}

		return false;
	}
}

