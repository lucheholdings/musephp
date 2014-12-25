<?php
namespace Clio\Extra\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Context;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\ArrayTool\Coder\Coder;
use Clio\Component\Tool\Serializer\Strategy\AbstractStrategy;
use Clio\Component\Tool\Serializer\Strategy\SerializationStrategy,
	Clio\Component\Tool\Serializer\Strategy\DeserializationStrategy
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
	 * {@inheritdoc}
	 */
	private $coder;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(Normalizer $normalizer, Coder $coder)
	{
		$this->normalizer = $normalizer;
		$this->coder = $coder;
	}

	/**
	 * {@inheritdoc}
	 */
	public function doSerialize($data, $format, Context $context)
	{
		$normalized = $this->getNormalizer()->normalize($data, $context->get('normalizer_context', null));

		// Convert normalized field to array field
		//$rule = $context->getCodingStandard();

		return $this->getCoder()->encode($normalized, $format);
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
		$normalized = $this->getCoder()->decode($data, $format);

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
    public function getCoder()
    {
        return $this->coder;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCoder(Coder $coder)
    {
        $this->coder = $coder;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getSupportFormats()
	{
		return $this->getCoder()->getKeys();
	}
}

