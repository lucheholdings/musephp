<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * Normalizer 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Normalizer implements 
	NormalizationStrategy,
	DenormalizationStrategy
{
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strategy;

	/**
	 * __construct 
	 * 
	 * @param NormalizerStrategy $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(NormalizerStrategy $strategy)
	{
		$this->strategy = $strategy;
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
		return $this->getstrategy()->canNormalize($object);
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
		$strategy = $this->getStrategy();
		if(!$strategy instanceof NormalizationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Normalizer Strategy dose not support denormalize.');
		}

		return $strategy->normalize($object);
	}

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canDenormalize($data, $class)
	{
		return $this->getstrategy()->canDenormalize($data, $class);
	}

	/**
	 * denormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function denormalize($object, $class)
	{
		$strategy = $this->getStrategy();
		if(!$strategy instanceof DenormalizationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Normalizer Strategy dose not support denormalize.');
		}

		return $strategy->denormalize($object, $class);
	}
    
    /**
     * Get strategy.
     *
     * @access public
     * @return strategy
     */
    public function getStrategy()
    {
        return $this->strategy;
    }
    
    /**
     * Set strategy.
     *
     * @access public
     * @param strategy the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setStrategy(NormalizerStrategy $strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }
}

