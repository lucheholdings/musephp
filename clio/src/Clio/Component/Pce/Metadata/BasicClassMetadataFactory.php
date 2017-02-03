<?php
namespace Clio\Component\Pce\Metadata;

use Clio\Component\Util\Execution\Invoke,
	Clio\Component\Util\Execution\MethodInvoker;

/**
 * ClassMetadataFactory 
 * 
 * @uses MetadataFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicClassMetadataFactory extends BasicMetadataFactory 
{
	public function __construct(array $mappingFactories = array())
	{
		parent::__construct('Clio\Component\Pce\Metadata\MappableClassMetadata', $mappingFactories);

		foreach($mappingFactories as $factory) {
			$this->addMappingFactory($factory);
		}
	}

	protected function doCreate(array $args)
	{
		return call_user_func_array(
			array($this, 'createClassMetadata'),
			$args
		);
	}

	public function createClassMetadata($class)
	{
		$metadata = new MappableClassMetadata($class);

		//$metadata->setMappings($this->createMetadataMappings($metadata));
		
		// Fixme: use Proxy to lazyload
		//$metadata->setMappingFactory($this->getMappingFactories());
		foreach($this->getMappingFactories()->getFactories() as $alias => $factory) {
			$metadata->setMapping($alias, new ProxyMapping(new Invoke(new MethodInvoker($factory, 'createMapping'), array($metadata))));
		}

		return $metadata;
	}
}
