<?php
namespace Clio\Framework\Accessor\Field;

use Clio\Component\Util\Accessor\Field\AbstractFieldAccessor;
use Clio\Component\Util\Tag\TagContainerAccessor;

/**
 * TagContainerFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerFieldAccessor extends AbstractFieldAccessor 
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
	 * @param TagContainerAccessor $tagAccessor 
	 * @access public
	 * @return void
	 */
	public function __construct(TagContainerAccessor $tagAccessor = null, $fieldName = 'tags')
	{
		$this->tagAccessor = $tagAccessor;

		parent::__construct($fieldName);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function get($object)
	{
		if($object->getTags()) {
			return $object->getTags()->getNameArray();
		}

		return array();
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($object, $value)
	{
		$value = (array)$value;
		return $this->getContainerAccessor()->replace($object->getTags(), $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isNull($object)
	{
		return (!$object->getTags() || (0 == count($object->getTags())));
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear($object)
	{
		$object->getTags()->removeAll();

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
     * @param TagContainerAccessor $tagAccessor 
     * @access public
     * @return void
     */
    public function setTagAccessor(TagContainerAccessor $tagAccessor)
    {
        $this->tagAccessor = $tagAccessor;
        return $this;
    }
}

