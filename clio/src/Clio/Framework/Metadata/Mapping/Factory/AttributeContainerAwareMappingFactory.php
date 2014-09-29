<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\MappingFactory;
use Clio\Component\Pce\Metadata\Metadata,
	Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Framework\Metadata\Mapping\Loader as MappingLoader;
use Clio\Framework\Metadata\Mapping\AttributeContainerAwareMapping;
/**
 * AttributeContainerAwareMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAwareMappingFactory implements MappingFactory 
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
		
		if($this->isSupportedMetadata($metadata)) {
			$mapping = new AttributeContainerAwareMapping();
		}

		return $mapping;
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
		return ($metadata instanceof ClassMetadata) && ($metadata->implementsInterface('Clio\Component\Util\Attribute\AttributeContainerAware'));
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'attribute_container_aware';
	}
}

