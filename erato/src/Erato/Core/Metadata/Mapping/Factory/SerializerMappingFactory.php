<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Extra\Metadata\Mapping\Factory\AbstractRegistryServiceMappingFactory;
use Erato\Core\Metadata\Mapping\SerializerMapping;
use Clio\Component\Tool\Serializer\Serializer;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Injection\ClassInjector;

/**
 * SerializerMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SerializerMappingFactory extends AbstractRegistryServiceMappingFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{
		if(isset($options['serializer'])) {
			$serializer = $options['serializer'];
		} else {
			$serializer = $this->getServiceId('serializer');
		}

		return new SerializerMapping($metadata, $this->getRegistry(), $serializer, $options);
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

