<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Extra\Metadata\Mapping\Factory\AbstractRegistryServiceMappingFactory;
use Erato\Core\Metadata\Mapping\SchemifierMapping;
use Clio\Component\Tool\Schemifier\Schemifier;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Injection\ClassInjector;

/**
 * SchemifierMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemifierMappingFactory extends AbstractRegistryServiceMappingFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{
		if(isset($options['factory'])) {
			$factory = $options['factory'];
		} else {
			$factory = $this->getServiceId('factory');
		}
		return new SchemifierMapping($metadata, $this->getRegistry(), $factory, $options);
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

