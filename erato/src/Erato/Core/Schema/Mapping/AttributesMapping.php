<?php
namespace Erato\Core\Schema\Mapping;

use Erato\Core\Schema\Mappings;

use Clio\Component\Metadata\Mapping\AbstractMapping,
	Clio\Component\Metadata\Metadata
;

use Clio\Component\Type;
use Clio\Component\Attribute;

/**
 * AttributesMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributesMapping extends AbstractMapping 
{
    const DEFAULT_ATTRIBUTE_CLASS = 'Clio\Component\Attribute\SimpleAttribute';

	/**
	 * _accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_accessor;

	/**
	 * getAttributeAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeAccessor()
	{
		if(!$this->_accessor) {
			$this->_accessor = new Attribute\AttributeAccessor(new Attribute\AttributeComponentFactory($this->getAttributeClass()));
		}

		return $this->_accessor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return Mappings::MAPPING_ATTRIBUTES;
	}

	public function getFieldName()
	{
		return $this->getOption('field_name');
	}

    /**
     * getFieldMetadata 
     * 
     * @access public
     * @return void
     */
	public function getFieldMetadata()
	{
		return $this->getMetadata()->getField($this->getFieldName());
	}

    /**
     * getAttributeClass 
     *    
     * @access public
     * @return void
     */
	public function getAttributeClass()
	{
		$field = $this->getFieldMetadata();
        $attrsType = $field->getTypeSchema();

        if(($attrsType->getType() instanceof Type\Actual\ArrayType) && $field->hasOption('internal_types')) {
            $internalTypes = $attrsType->getType()->parseInternalTypes($field->getOption('internal_types'));
            if(isset($internalTypes['value'])) {
                return $internalTypes['value'];
            }
        }
        return self::DEFAULT_ATTRIBUTE_CLASS;
	}
}

