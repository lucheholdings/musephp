<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\AbstractFactory as AbstractMappingFactory;
use Erato\Core\Metadata\Mapping\NormalizerMapping;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Injection\ClassInjector;

/**
 * NormalizerMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NormalizerMappingFactory extends AbstractMappingFactory 
{
	/**
	 * normalizer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $normalizer;

	private $injector;

	/**
	 * __construct 
	 * 
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function __construct(Normalizer $normalizer)
	{
		$this->normalizer = $normalizer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata)
	{
		return new NormalizerMapping($metadata);
	}

	/**
	 * isSupportedMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return ($metadata instanceof SchemaMetadata);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			$this->injector = new ClassInjector('Erato\Core\Metadata\Mapping\NormalizerMapping', 'setNormalizer', array($this->getNormalizer()));
		}

		return $this->injector;
	}
    
    /**
     * getNormalizer 
     * 
     * @access public
     * @return void
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    /**
     * setNormalizer 
     * 
     * @param Normalizer $normalizer 
     * @access public
     * @return void
     */
    public function setNormalizer(Normalizer $normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }
}

