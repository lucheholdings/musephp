<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Exception\UnsupportedException;
use Clio\Component\Util\Type as Types,
	Clio\Component\Util\Type\Resolver as TypeResolver
;

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

	private $typeResolver;

	/**
	 * __construct 
	 * 
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy, TypeResolver $typeResolver = null)
	{
		$this->strategy = $strategy;
		$this->typeResolver = $typeResolver;
	}

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canNormalize($data, $type, Context $context = null)
	{
        if(!$type instanceof Type) {
            if(!$context) {
                $context = $this->createContext();
            }
            $type = $context->getTypeResolver()->resolve($type, array('data' => $data));
        }

		return $this->getStrategy()->canNormalize($data, $type);
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
		if(null === $data) {
			return $data;
		}

		if(!$context) {
            $context = $this->createContext();
		}

		// Clean type 
		$type = $context->getTypeResolver()->resolve($type, array('data' => $data));

		if(!$type->isValidData($data)) {
			if($context->getScopeConfiguration(NormalizerOptions::OPT_PREFER_DATA, true)) {
				$type = $context->getTypeResolver()->resolve('mixed', array('data' => $data));
			} else {
				throw new \InvalidArgumentException('Given type and data is not matched.');
			}
		}

		// Original Scope
		if($context->isEmptyScope()) {
			$context->enterScope($data, $type, '_');
		}

		$strategy = $this->getStrategy();
		if(!$strategy instanceof Strategy\NormalizationStrategy) {
			throw new UnsupportedException('Normalizer Strategy dose not support normalize.');
		}
        
        // 
        $context->notify('normalizer.normalize.begin', array('type' => $type, 'data' => $data));

		$normalized = $strategy->normalize($data, $type, $context);

		if(is_array($normalized)) {
            // if NormalizerOptions::OPT_COMPACT, then replace null value 
			if($context->getScopeConfiguration(NormalizerOptions::OPT_COMPACT, true)) {
				$normalized = array_filter($normalized, function($v) {
						return null !== $v;
					});
			}

			if((1 == count($normalized)) && $context->getScopeConfiguration(NormalizerOptions::PREFER_SCALAR, false)) {
				$normalized = array_pop($normalized);
			}
		}

        $context->notify('normalizer.normalize.end', array('type' => $type, 'data' => $data));

		return $normalized;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context = null)
	{
        if(!$type instanceof Type) {
            if(!$context) {
                $context = $this->createContext();
            }
            $type = $context->getTypeResolver()->resolve($type, array('data' => $data));
        }
		return $this->getStrategy()->canDenormalize($data, $type);
	}

	/**
	 * {@inheritdoc}
	 */
	public function denormalize($data, $type, Context $context = null)
	{
		if(is_object($data)) {
			return $data;
		}
		try {
			if(!$context) {
                $context = $this->createContext();
			}

			$type = $context->getTypeResolver()->resolve($type, array('data' => $data));

			// Original Scope
			if($context->isEmptyScope()) {
				$context->enterScope($data, $type, '_');
			}

			$strategy = $this->getStrategy();
			if(!$strategy instanceof Strategy\DenormalizationStrategy) {
				throw new UnsupportedException('Normalizer Strategy dose not support denormalize.');
			}

            $context->notify('normalizer.denormalize.begin', array('type' => $type, 'data' => $data));
			$denormalized = $strategy->denormalize($data, $type, $context); 

            $context->notify('normalizer.denormalize.end', array('type' => $type, 'data' => $data));

			return $denormalized;
			
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
    
    public function getTypeResolver()
    {
        return $this->typeResolver;
    }
    
    public function setTypeResolver(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
        return $this;
    }
    
    /**
     * createContext 
     *   Create default Normalizer Context 
     * @access public
     * @return void
     */
    public function createContext()
    {
        $context = new Context($this->typeResolver);
        $context->setNormalizer($this);
        return $context;
    }
}

