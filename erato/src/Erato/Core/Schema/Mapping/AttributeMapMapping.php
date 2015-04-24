<?php
namespace Erato\Core\Schema\Mapping;

use Erato\Core\Schema\Mappings;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping,
	Clio\Component\Util\Metadata\Metadata
;

use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Attribute\AttributeComponentFactory;
use Clio\Component\Util\Type\Type as TypeInterface;

/**
 * AttributeMapMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapMapping extends AbstractMapping 
{
	/**
	 * fieldName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldName;

	/**
	 * defaultClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultClass;

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
	public function __construct(Metadata $metadata, $fieldName = 'attributes', $defaultClass = 'Clio\Component\Util\Attribute\SimpleAttribute')
	{
		parent::__construct($metadata);
		$this->fieldName = $fieldName;
		$this->defaultClass = $defaultClass;
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
		return Mappings::MAPPING_ATTRIBUTES;
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

		if($type->options->has('field_type')) {
			$type = $type->options->get('field_type');
		}

		if(($type instanceof TypeInterface) && !class_exists($type->getName())) {
			$type = $this->defaultClass;
		}

		return (string)$type;
	}

	public function dumpConfig()
	{
		return array(
			'fieldname' => $this->getFieldName(),
			'classname' => $this->getAttributeClass(),
		);
	}

	public function serialize(array $extra = array())
	{
		$extra['fieldName'] = $this->fieldName;
		$extra['defaultClass'] = $this->defaultClass;
		return parent::serialize($extra);
	}

	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);

		$this->fieldName = $extra['fieldName'];
		$this->defaultClass = $extra['defaultClass'];

		return $extra;
	}
}
