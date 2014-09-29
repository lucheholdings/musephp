<?php
namespace Calliope\Framework\Core\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\MappingFactory;
use Clio\Component\Pce\Metadata\Metadata,
	Clio\Component\Pce\Metadata\ClassMetadata;

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
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;
		if($metadata instanceof ClassMetadata) {
			// Create 
			$mapping = new SchemeMapping($metadata);
		}

		return $mapping;
	}
}

