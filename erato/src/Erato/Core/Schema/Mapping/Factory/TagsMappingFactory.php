<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Schema;
use Clio\Component\Pattern\Factory\Exception as FactoryException;
use Erato\Core\Schema\Mapping\TagsMapping;

/**
 * TagsMappingFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagsMappingFactory extends AbstractSchemaMetadataMappingFactory 
{
    private $defaultOptions = array(
            'field_name' => 'tags',
        );

	/**
	 * __construct 
	 * 
	 * @param string $defaultFieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($defaultFieldName = 'tags')
	{
		$this->defaultOptions['field_name'] = $defaultFieldName;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
        $mapping = null;
		if(($metadata instanceof Schema) && ($metadata->getType()->isType('Clio\Component\Tag\TagSetAware'))) {
            $options = array_merge($this->defaultOptions, $options);
			// 
			$mapping = new TagsMapping($metadata, $options);
		} else {
			throw new FactoryException\UnsupportedException('Metadata which is not a Schema or is not aware TagSeteAware is not supported');
        }

		return $mapping;
	}

	/**
	 * getDefaultFieldName 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getDefaultFieldName()
	{
		return $this->defaultOptions['field_name'];
	}

    public function setDefaultFieldName($fieldName)
    {
        $this->defaultOptions['field_name'] = $fieldName;
    }
}

