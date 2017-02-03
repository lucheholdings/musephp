<?php
namespace Clio\Component\Util\FieldAccessor;

use Clio\Component\Util\FieldAccessor\Property\PropertyFieldAccessor;
use Clio\Component\Util\FieldAccessor\Property\IgnorePropertyFieldAccessor;

/**
 * PropertyFieldCollectionAccessor
 *   PropertyAccessor for Field Collection 
 * 
 * @uses AbstractPropertyAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFieldCollectionAccessor extends AbstractFieldAccessor
{
	/**
	 * fields 
	 * 
	 * @var array
	 * @access private
	 */
	private $fields = array();

	/**
	 * addFieldAccessor 
	 * 
	 * @param PropertyFieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function addFieldAccessor(PropertyFieldAccessor $accessor)
	{
		$this->fields[$accessor->getField()] = $accessor;

		return $this;
	}

	/**
	 * hasFieldAccessor 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function hasFieldAccessor($field)
	{
		return isset($this->fields[$field]);
	}

	/**
	 * getFieldAccessor 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function getFieldAccessor($field)
	{
		if(!isset($this->fields[$field])) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->fields[$field];
	}

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
		$accessor = $this->getFieldAccessor($key);

		return $accessor->getValue($object); 
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
		$accessor = $this->getFieldAccessor($key);
		$accessor->setValue($object, $value);

		return $this;
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
		$accessor = $this->getFieldAccessor($key);
		$accessor->clearValue($object);

		return $this;
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
		$accessor = $this->getFieldAccessor($key);
		return $accessor->isValueNull($object);
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
		try {
			$accessor = $this->getFieldAccessor($field);
			return $accessor->isSupportMethod($object, $field, $type);
		} catch(\Exception $ex) {
			return false;
		}
	}

	/**
	 * getFields 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFields($object)
	{
		$properties = array();

		foreach($this->fields as $field => $accessor) {
			if($accessor instanceof IgnorePropertyFieldAccessor)
				continue;
			$properties[$field] = $accessor->getValue($object);
		}

		return $properties;
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($object = null)
	{
		return array_keys(array_filter($this->fields, function($accessor){
			if($accessor instanceof IgnorePropertyFieldAccessor)
				return false;
			
			return true;
		}));
	}
}
