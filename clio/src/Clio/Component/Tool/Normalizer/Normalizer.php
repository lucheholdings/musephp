<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Exception\UnsupportedException;
use Clio\Component\Util\Type as Types,
	Clio\Component\Util\Type\Type as TypeInterface,
	Clio\Component\Util\Type\Resolver as TypeResolver
;

use Psr\Log as PsrLog;


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
	Strategy\DenormalizationStrategy,
	PsrLog\LoggerAwareInterface
{
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strategy;

	private $typeResolver;

	private $logger;

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
		if(null === $data) {
			return $data;
		}

		if(!$context) {
			$context = new Context($this->getTypeResolver());
			$context->setNormalizer($this);
		}

		// if type is not specified, then 
		if(!$type instanceof TypeInterface) {
			$type = new Types\FieldType($type);
		}

		// Convert FieldType to NormalizerType 
		$type = $context->getTypeResolver()->resolve($type, array('data' => $data));

		if(!$type->isValidData($data)) {
			if($context->getScopeConfiguration('prefer_data', true)) {
				$type = $context->getTypeResolver()->resolve(new Types\FieldType(), array('data' => $data));
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

		if($type)
			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'Start Normalize.', array('type' => $type->getName(), 'path' => $context->getScopePath()));
		else 
			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'Start Normalize');

		$normalized = $strategy->normalize($data, $type, $context);

		if(is_array($normalized)) {
			if($context->getScopeConfiguration('compact', true)) {
				$normalized = array_filter($normalized, function($v) {
						return !empty($v);
					});
			}

			if((1 == count($normalized)) && $context->getScopeConfiguration('prefer_scalar', true)) {
				$normalized = array_pop($normalized);
			}
		}

		if($type)
			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'End Normalize.', array('type' => $type->getName(), 'path' => $context->getScopePath()));
		else 
			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'End Normalize');

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
		if(is_object($data)) {
			return $data;
		}
		try {
			if(!$context) {
				$context = new Context($this->getTypeResolver());
				$context->setNormalizer($this);
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

			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'Start Denormalize.', array('type' => $type->getName(), 'path' => $context->getScopePath()));
			$denormalized = $strategy->denormalize($data, $type, $context); 

			$this->getLogger()->log(PsrLog\LogLevel::DEBUG, 'End Denormalize.', array('type' => $type->getName(), 'path' => $context->getScopePath()));

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
    
    public function getLogger()
    {
		if(!$this->logger) 
			$this->logger = new PsrLog\NullLogger();

        return $this->logger;
    }
    
    public function setLogger(PsrLog\LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }
}

