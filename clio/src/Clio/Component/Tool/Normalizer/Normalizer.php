<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Tool\ArrayTool\Mapper;

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
	public function normalize($object, Mapper $mapper = null)
	{
		$strategy = $this->getStrategy();
		if(!$strategy instanceof NormalizationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Normalizer Strategy dose not support denormalize.');
		}

		$data = $strategy->normalize($object);

		if($mapper && is_array($data)) {
			$data = $mapper->map($data);
		}
		return $data;
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
	public function denormalize($object, $class, Mapper $mapper = null)
	{
		$strategy = $this->getStrategy();
		if(!$strategy instanceof DenormalizationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Normalizer Strategy dose not support denormalize.');
		}

		if(is_array($object) && $mapper) {
			$object = $mapper->map($object);
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

