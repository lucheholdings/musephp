<?php
namespace Calliope\Framework\Core\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Metadata,
	Clio\Component\Util\Metadata\Metadata\Schema\SchemaMetadata,
	Clio\Component\Util\Metadata\Mapping\Factory as MappingFactory,
	Clio\Component\Util\Metadata\Schema\ClassMetadata;

use Calliope\Framework\Core\Metadata\Mapping\SchemaMapping;
use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * SchemaMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaMappingFactory implements MappingFactory
{
	private $options;

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;
		if($metadata instanceof ClassMetadata) {
			// Create 
			$mapping = new SchemaMapping($metadata);
		}

		return $mapping;
	}

	public function getInjector()
	{
		return null;
	}

	public function isSupportedMetadata(Metadata $metadata)
	{
		return $metadata instanceof SchemaMetadata;
	}

	public function setOptions(array $options)
	{
		$this->options = $options;
	}

	public function getOptions()
	{
		return $this->options;
	}
}

