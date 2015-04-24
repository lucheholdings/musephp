<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Erato\Core\Metadata\Mapping\TagSetMapping;

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
	const CONTAINER_INTERFACE = 'Clio\Component\Util\Tag\TagSetAware';

	/**
	 * defaultFieldName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultFieldName;

	/**
	 * defaultClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultClass;

	/**
	 * __construct 
	 * 
	 * @param string $defaultFieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($defaultFieldName = 'tags', $defaultClass = 'Clio\Component\Util\Tag\SimpleTag')
	{
		$this->defaultFieldName = $defaultFieldName;
		$this->defaultClass = $defaultClass;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
		if(($metadata instanceof ClassMetadata) && ($metadata->getReflectionClass()->implementsInterface(self::CONTAINER_INTERFACE))) {

			// 
			$mapping = new TagSetMapping($metadata, $this->getTagField($metadata), $this->getDefaultClass(), $options);
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
    
    public function getDefaultClass()
    {
        return $this->defaultClass;
    }
    
    public function setDefaultClass($defaultClass)
    {
        $this->defaultClass = $defaultClass;
        return $this;
    }
}

