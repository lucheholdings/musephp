<?php
namespace Clio\Extra\Accessor\Field;

use Clio\Component\Util\Accessor\Field\AbstractSingleFieldAccessor;
use Clio\Component\Util\Tag\TagSetAccessor;

/**
 * TagSetFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetFieldAccessor extends AbstractSingleFieldAccessor 
{
	/**
	 * tagAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tagAccessor;

	/**
	 * __construct 
	 * 
	 * @param TagSetAccessor $tagAccessor 
	 * @access public
	 * @return void
	 */
	public function __construct(TagSetAccessor $tagAccessor = null, $fieldName = 'tags')
	{
		$this->tagAccessor = $tagAccessor;

		parent::__construct($fieldName);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function get($object)
	{
		if($object->getTagSet()) {
			return $object->getTagSet()->getNameArray();
		}

		return array();
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($object, $value)
	{
		$value = (array)$value;
		return $this->getContainerAccessor()->replace($object->getTagSet(), $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isNull($object)
	{
		return (!$object->getTagSet() || (0 == count($object->getTagSet())));
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear($object)
	{
		$object->getTagSet()->clear();

		return $this;
	}

    /**
     * getTagAccessor 
     * 
     * @access public
     * @return void
     */
    public function getTagAccessor()
    {
        return $this->tagAccessor;
    }
    
    /**
     * setTagAccessor 
     * 
     * @param TagSetAccessor $tagAccessor 
     * @access public
     * @return void
     */
    public function setTagAccessor(TagSetAccessor $tagAccessor)
    {
        $this->tagAccessor = $tagAccessor;
        return $this;
    }
}

