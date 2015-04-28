<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Accessor\SchemaAccessor;

use Clio\Component\Util\Type;
use Clio\Component\Util\Tag;

/**
 * TagsMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagsMapping extends AbstractMapping 
{
    const DEFAULT_TAG_CLASS = 'Clio\Component\Util\Tag\SimpleTag';

	/**
	 * _accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_accessor;

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
		return 'tags';
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
	 * getTagClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTagClass()
	{
		$field = $this->getFieldMetadata();
        $tagsType = $field->getTypeSchema();

        if(($tagsType->getType() instanceof Type\Actual\ArrayType) && $field->hasOption('internal_types')) {
            $internalTypes = $tagsType->getType()->parseInternalTypes($field->getOption('internal_types'));

            if(isset($internalTypes['value'])) {
                return $internalTypes['value'];
            }
        }
        return self::DEFAULT_TAG_CLASS;
    }
}

