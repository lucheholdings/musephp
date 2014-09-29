<?php
namespace Clio\Framework\FieldAccessor\Property;

use Clio\Component\Pce\FieldAccessor\Property\AbstractPropertyFieldAccessor;
/**
 * TagContainerPrepertyFieldAccessor 
 * 
 * @uses AbstractPropertyFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerPropertyFieldAccessor extends AbstractPropertyFieldAccessor
{
	private $_tagAccessor;
	
	/**
	 * get 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getValue($object)
	{
		if($object->getTags()) {
			return $object->getTags()->getNameArray();
		}

		return array();
	}

	/**
	 * set 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setValue($object, $value)
	{
		return $this->getContainerAccessor()->replace($object->getTags(), $value);
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function isValueNull($object)
	{
		return (!$object->getTags() || (count($object->getTags()) == null));
	}

	/**
	 * clearValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function clearValue($object)
	{
		$object->getTags()->removeAll();

		return $this;
	}

	/**
	 * getContainerAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContainerAccessor()
	{
		if(!$this->_tagAccessor) {
			if(!$this->getClassMapping()->getClassMetadata()->hasMapping('tag_container_aware')) { 
				throw new \Clio\Component\Exception\RuntimeException(sprintf('ClassMetadata of "%s" is not aware "tag_container_aware" Mapping.', $this->getClassMapping()->getReflectionClass()->getName()));
			}

			$this->_tagAccessor = $this->getClassMapping()->getClassMetadata()->getMapping('tag_container_aware')->getContainerAccessor();

		}
		return $this->_tagAccessor;
	}
}

