<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Extra\Metadata\Mapping\Factory\AbstractRegistryServiceMappingFactory;
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
class NormalizerMappingFactory extends AbstractRegistryServiceMappingFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{
		if(isset($options['normalizer'])) {
			$normalizer = $options['normalizer'];
		} else {
			// Get default normalizer service
			$normalizer = $this->getServiceId('normalizer');
		}
		return new NormalizerMapping($metadata, $this->getRegistry(), $normalizer, $options);
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
}

