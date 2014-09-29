<?php
namespace Clio\Framework\FieldAccessor;

use Clio\Component\Pce\FieldAccessor\AbstractFieldAccessor;
use Clio\Component\Util\Attribute\AttributeContainerAware;
/**
 * AttributeContainerFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerFieldAccessor extends AbstractFieldAccessor
{
	private $_attributeAccessor;
	
	/**
	 * get 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($object, $key)
	{
		return $this->getAttributeAccessor()->get($object->getAttributes(), $key);
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
	public function set($object, $key, $value)
	{
		return $this->getAttributeAccessor()->set($object->getAttributes(), $key, $value, $object);
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function isNull($object, $key)
	{
		return (!$object->getAttributes()->hasKey($key) || (null == $object->getAttributes()->get($key)->getValue()));
	}

	/**
	 * clear 
	 * 
	 * @param mixed $object 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function clear($object, $key)
	{
		$object->getAttributes()->remove($key);

		return $this;
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($object, $field, $type)
	{
		return true;
	}


	/**
	 * getFields 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFields($object)
	{
		if($object && ($object instanceof AttributeContainerAware)) {
			return $object->getAttributes()->getKeyValueArray();
		} else {
			return array();
		}
	}

	/**
	 * getFieldNames 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($object = null)
	{
		if($object && ($object instanceof AttributeContainerAware)) {
			return $object->getAttributes()->getKeys();
		} else {
			return array();
		}
	}

	/**
	 * getAttributeAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeAccessor()
	{
		if(!$this->_attributeAccessor) {
			if(!$this->getClassMapping()->getClassMetadata()->hasMapping('attribute_container_aware')) { 
				throw new \Clio\Component\Exception\RuntimeException(sprintf('ClassMetadata of "%s" is not aware "attribute_container_aware" Mapping.', $this->getClassMapping()->getReflectionClass()->getName()));
			}

			$this->_attributeAccessor = $this->getClassMapping()->getClassMetadata()->getMapping('attribute_container_aware')->getAttributeAccessor();

		}
		return $this->_attributeAccessor;
	}
}

