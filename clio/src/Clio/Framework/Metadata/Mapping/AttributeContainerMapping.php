<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Accessor\SchemaAccessor;

use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Attribute\AttributeComponentFactory;

/**
 * AttributeContainerMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerMapping extends AbstractMapping 
{
	/**
	 * fieldName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldName;

	/**
	 * _accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_accessor;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, $fieldName = 'attributes')
	{
		parent::__construct($metadata);
		$this->fieldName = $fieldName;
	}

	/**
	 * getAttributeAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeAccessor()
	{
		if(!$this->_accessor) {
			$this->_accessor = new AttributeAccessor(new AttributeComponentFactory($this->getAttributeClass()));
		}

		return $this->_accessor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'attribute_container';
	}

	public function getFieldName()
	{
		return $this->fieldName;
	}

	/**
	 * getAttributeFieldMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeFieldMetadata()
	{
		return $this->getMetadata()->hasField($this->getFieldName()) ? $this->getMetadata()->getField($this->getFieldName()) : null;
	}

	public function getAttributeClass()
	{
		$field = $this->getAttributeFieldMetadata();
		if(!$field) {
			return null;
		}
		$type = $field->getType();

		if($type->hasInternalType()) {
			$type = $type->getInternalType();
		}

		return (string)$type;
	}
}
