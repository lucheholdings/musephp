<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\MappingFactory;
use Clio\Component\Pce\Metadata\Metadata,
	Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Framework\Metadata\Mapping\TagContainerAwareMapping;
/**
 * TagContainerAwareMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerAwareMappingFactory implements MappingFactory 
{
	
	/**
	 * createMapping 
	 * 
	 * @param Meatdata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;

		// FIXME
		$tagClass = 'Clio\Component\Util\Tag\Tag';

		if(($metadata instanceof ClassMetadata) && ($metadata->implementsInterface('Clio\Component\Util\Tag\TagContainerAware'))) {
			$mapping = new TagContainerAwareMapping($tagClass);
		}

		return $mapping;
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'tag_container_aware';
	}
}

