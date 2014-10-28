<?php
namespace Calliope\Framework\Core\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Schema\MappingFactory;
use Clio\Component\Util\Metadata\SchemaMetadata,
	Clio\Component\Util\Metadata\Schema\ClassMetadata;

use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * SchemeMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeMappingFactory implements MappingFactory
{
	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(SchemaMetadata $metadata, array $options = array())
	{
		$mapping = null;
		if($metadata instanceof ClassMetadata) {
			// Create 
			$mapping = new SchemeMapping($metadata);
		}

		return $mapping;
	}
}

