<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Accessor\SchemaAccessor;

use Clio\Component\Util\Tag\TagAccessor;
use Clio\Component\Util\Tag\TagComponentFactory;

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
	public function __construct(Metadata $metadata, $fieldName = 'tags', $defaultClass = 'Clio\Component\Util\Tag\SimpleTag')
	{
		parent::__construct($metadata);
		$this->fieldName = $fieldName;
		$this->defaultClass = $defaultClass;
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

		if(!class_exists($type)) {
			$type = $this->defaultClass;
		}

		return (string)$type;
	}

	public function dumpConfig()
	{
		return array(
			'fieldname' => $this->getFieldName(),
			'classname' => $this->getTagClass(),
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

