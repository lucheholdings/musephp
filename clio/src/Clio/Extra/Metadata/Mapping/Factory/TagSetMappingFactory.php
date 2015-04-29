<?php
namespace Clio\Extra\Metadata\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Schema\ClassMetadata;
use Clio\Extra\Metadata\Mapping\TagSetMapping;

/**
 * TagSetMappingFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetMappingFactory extends AbstractSchemaMetadataMappingFactory 
{
	const CONTAINER_INTERFACE = 'Clio\Component\Tag\TagSetAware';

	/**
	 * defaultFieldName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultFieldName;

	/**
	 * __construct 
	 * 
	 * @param string $defaultFieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($defaultFieldName = 'tags')
	{
		$this->defaultFieldName = $defaultFieldName;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
		if(($metadata instanceof ClassMetadata) && ($metadata->getReflectionClass()->implementsInterface(self::CONTAINER_INTERFACE))) {

			// 
			$mapping = new TagSetMapping($metadata, $this->getTagField($metadata));
		} else {
			throw new \InvalidArgumentException();
		}

		return $mapping;
	}

	/**
	 * getTagField 
	 * 
	 * @param mixed $metadata 
	 * @access protected
	 * @return void
	 */
	protected function getTagField($metadata)
	{
		return $this->getDefaultFieldName();
	}

	/**
	 * getDefaultFieldName 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getDefaultFieldName()
	{
		return $this->defaultFieldName;
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
		if(!parent::isSupportedMetadata($metadata))
			return false;
			
		if(!$metadata instanceof ClassMetadata) {
			return false;	
		}
		
		return $metadata->getReflectionClass()->implementsInterface(self::CONTAINER_INTERFACE);
	}
}

