<?php
namespace Clio\Extra\Serializer\Strategy;

use Clio\Component\Serializer\Context;
use Clio\Component\Normalizer\Normalizer;
use Clio\Component\ArrayTool\;
use Clio\Bridge\SymfonyComponents\ArrayTool\\YamlCoder;
use Clio\Component\ArrayTool\Mapper\RecursiveKeyMapper;
use Clio\Component\Serializer\Strategy\AbstractStrategy;
use Clio\Component\Serializer\Strategy\SerializationStrategy,
	Clio\Component\Serializer\Strategy\DeserializationStrategy
;

/**
 * NormalizerStrategy 
 * 
 * @uses AbstractStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NormalizerStrategy extends AbstractStrategy implements SerializationStrategy, DeserializationStrategy 
{
	/**
	 * {@inheritdoc}
	 */
	private $normalizer;

    /**
     * coders 
     * 
     * @var ArrayTool\\CoderMap 
     * @access private
     */
	private $coders;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(Normalizer $normalizer, Coder\CoderMap $coders)
	{
		$this->normalizer = $normalizer;
		$this->coders = $coders;
	}

	/**
	 * {@inheritdoc}
	 */
	public function doSerialize($data, $format, Context $context)
	{
		$normalized = $this->getNormalizer()->normalize($data, $context->get('normalizer_context', null));

		// Convert normalized field to array field
		if($context->has('field_mapper')) {
			$mapper = new RecursiveKeyMapper($context->get('field_mapper'));
			$normalized = $mapper->map($normalized);
		}

		return $this->coders->encode($normalized, $format);
	}

	public function canSerialize($data, $format = null)
	{
		return in_array($format, $this->getSupportFormats()); 
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDeserialize($data, $type, $format, Context $context)
	{
		// Decode the data to normalized data with Decoder
		$normalized = $this->coders->decode($data, $format);

		// Convert normalized field key to property field
		if($context->has('field_mapper')) {
			$mapper = new RecursiveKeyMapper($context->get('field_mapper'));
			$normalized = $mapper->inverseMap($normalized);
		}

		// Denormalize the data with Normalizer.
		return $this->getNormalizer()->denormalize($data, $type, $context->get('normalizer_context', null));
	}
    
	public function canDeserialize($data, $type, $format = null)
	{
		return in_array($format, $this->getSupportFormats()); 
	}

    /**
     * {@inheritdoc}
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setNormalizer(Normalizer $normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function gets()
    {
        return $this->coders;
    }
    
    /**
     * {@inheritdoc}
     */
    public function sets(Coder\CoderMap $coders)
    {
        $this->coders = $coders;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getSupportFormats()
	{
        return $this->coders->getKeys();
	}
}

