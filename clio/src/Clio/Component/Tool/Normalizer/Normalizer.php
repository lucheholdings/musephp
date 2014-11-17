<?php
namespace Clio\Component\Tool\Normalizer;

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
	Strategy\NormalizationStrategy,
	Strategy\DenormalizationStrategy
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
	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$context) {
			$context = new Context();
			$context->setNormalizer($this);
		}

		if(!$type) {
			$type = $context->getTypeRegistry()->guessType($data);
		} else if(!$type instanceof Type) {
			$type = $context->getTypeRegistry()->getType($type);
		}

		$strategy = $this->getStrategy();
		if(!$strategy instanceof Strategy\NormalizationStrategy) {
			throw new UnsupportedException('Normalizer Strategy dose not support normalize.');
		}

		$normalized = $strategy->normalize($data, $type, $context);

		return $normalized;
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
	public function denormalize($data, $type, Context $context = null)
	{
		try {
			if(!$context) {
				$context = new Context();
				$context->setNormalizer($this);
			}

			if(!$type instanceof Type) {
				$type = $context->getTypeRegistry()->getType($type);
			}

			$strategy = $this->getStrategy();
			if(!$strategy instanceof Strategy\DenormalizationStrategy) {
				throw new UnsupportedException('Normalizer Strategy dose not support denormalize.');
			}

			return $strategy->denormalize($data, $type, $context); 
			
		} catch(\Exception $ex) {
			throw new \Exception(sprintf('Failed to denormalize data [%s]', json_encode($data)), 0, $ex);
		}
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

