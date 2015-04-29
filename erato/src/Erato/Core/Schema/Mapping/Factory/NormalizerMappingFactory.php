<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Extra\Metadata\Mapping\Factory\AbstractRegistryServiceMappingFactory;
use Erato\Core\Schema\Mapping\NormalizerMapping,
	Erato\Core\Schema\Mapping\NormalizerFieldMapping;
use Clio\Component\Normalizer\Normalizer;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\SchemaMetadata;
use Clio\Component\Injection\ClassInjector;

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

		if($metadata instanceof SchemaMetadata) {
			if(isset($options['normalizer'])) {
				$normalizer = $options['normalizer'];
			} else {
				// Get default normalizer service
				$normalizer = $this->getServiceId('normalizer');
			}
			return new NormalizerMapping($metadata, $this->getRegistry(), $normalizer, $options);
		} else {
			return new NormalizerFieldMapping($metadata, $options);
		}
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
		return true;
		//return ($metadata instanceof SchemaMetadata);
	}
}

