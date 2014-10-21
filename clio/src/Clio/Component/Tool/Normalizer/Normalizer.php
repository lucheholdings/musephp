<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Tool\ArrayTool\Mapper;
use Clio\Component\Exception\UnsupportedException;

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
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy)
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
	public function canNormalize($object, $type, Context $context)
	{
		return $this->getStrategy()->canNormalize($object, $type, $context);
	}

	/**
	 * normalize 
	 *   TopDown Normalizer 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function normalize($object, $type = null, Context $context = null)
	{
		if(!$context) {
			$context = new Context();
		}

		if(!$type) {
			$type = $context->getTypeRegsitry()->guessType($type);
		} else {
			$type = $context->getTypeRegistry()->getType($type);
		}

		$strategy = $this->getStrategy();
		if(!$strategy instanceof NormalizationStrategy) {
			throw new UnsupportedException('Normalizer Strategy dose not support denormalize.');
		}

		$data = $strategy->normalize($object, $type, $context);

		return $context->getMapper()->map($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return $this->getstrategy()->canDenormalize($data, $type, $context);
	}

	/**
	 * {@inheritdoc}
	 */
	public function denormalize(array $data, $class, Context $context = null)
	{
		if(!$context) {
			$context = new Context();
		}

		$strategy = $this->getStrategy();
		if(!$strategy instanceof DenormalizationStrategy) {
			throw new UnsupportedException('Normalizer Strategy dose not support denormalize.');
		}

		return $strategy->denormalize($context->getMapper()->map($data), $class, $context); 
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
    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }
}

