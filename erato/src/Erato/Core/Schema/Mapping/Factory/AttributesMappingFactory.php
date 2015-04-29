<?php
namespace Erato\Core\Schema\Mapping\Factory;

// Metadata 
use Clio\Component\Metadata\Metadata,
	Clio\Component\Metadata\Schema,
	Clio\Component\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory
;
use Clio\Component\Metadata\Exception as MetadataException;
// Mapping
use Erato\Core\Schema\Mapping\AttributesMapping;

/**
 * AttributesMappingFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributesMappingFactory extends AbstractSchemaMetadataMappingFactory 
{
    private $defaultOptions = array(
            'field_name' => 'attributes',
        );

	/**
	 * __construct 
	 * 
	 * @param string $defaultFieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($defaultFieldName = 'attributes')
	{
         $defaultOptions['field_name'] = $defaultFieldName;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
		if(($metadata instanceof Schema) && ($metadata->getType()->isType('Clio\Component\Attribute\AttributeMapAware'))) {
            $options = array_merge($this->defaultOptions, $options);
			// 
			$mapping = new AttributesMapping($metadata, $options);
		} else {
			throw new MetadataException\UnsupportedException('Metadata which is not a Schema or is not aware AttributeMapAware is not supported');
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

