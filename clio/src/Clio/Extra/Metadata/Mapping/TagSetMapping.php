<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Accessor\SchemaAccessor;

use Clio\Component\Tag\TagAccessor;
use Clio\Component\Tag\TagComponentFactory;

/**
 * TagSetMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetMapping extends AbstractMapping 
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
	public function __construct(Metadata $metadata, $fieldName = 'tags')
	{
		parent::__construct($metadata);
		$this->fieldName = $fieldName;
	}

	/**
	 * getTagAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTagAccessor()
	{
		if(!$this->_accessor) {
			$this->_accessor = new TagAccessor(new TagComponentFactory($this->getTagClass()));
		}

		return $this->_accessor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'tag_set';
	}

	public function getFieldName()
	{
		return $this->fieldName;
	}

	/**
	 * getTagFieldMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTagFieldMetadata()
	{
		return $this->getMetadata()->hasField($this->getFieldName()) ? $this->getMetadata()->getField($this->getFieldName()) : null;
	}

	/**
	 * getTagClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTagClass()
	{
		$field = $this->getTagFieldMetadata();
		if(!$field) {
			return self::DEFAULT_TAG_CLASS;
		}
		$type = $field->getType();

		if($type->hasInternalType()) {
			$type = $type->getInternalType();
		}

		return (string)$type;
	}
}

