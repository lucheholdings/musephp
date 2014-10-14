<?php
namespace Clio\Component\Util\Accessor;

/**
 * FieldAccessorCollection 
 * 
 * @uses AbstractFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorCollection extends AbstractAccessor 
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
	public function addFieldAccessor(FieldAccessor $accessor)
	{
		$this->fields[$accessor->getFieldName()] = $accessor;

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
			throw new \RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->fields[$field];
	}

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($container, $field)
	{
		$accessor = $this->getFieldAccessor($field);

		return $accessor->get($container); 
	}

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($container, $field, $value)
	{
		$accessor = $this->getFieldAccessor($field);
		$accessor->set($container, $value);

		return $this;
	}

	/**
	 * clear 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function clear($container, $key)
	{
		$accessor = $this->getFieldAccessor($key);
		$accessor->clearValue($container);

		return $this;
	}

	/**
	 * isExists
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function isExists($container, $fieldName)
	{
		if(!$this->hasFieldAccessor($fieldName)) {
			return false;	
		}

		return $this->getFieldAccessor()->isEmpty($container);
	}

	/**
	 * isEmpty 
	 * 
	 * @param mixed $container 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function isEmpty($container, $fieldName)
	{
		return $this->getFieldAccessor($fieldName)->isEmpty($container);
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($container, $field, $type)
	{
		try {
			$accessor = $this->getFieldAccessor($field);
			return $accessor->isSupportMethod($container, $type);
		} catch(\Exception $ex) {
			// Field not exists, so not supported.
			return false;
		}
	}

	/**
	 * getFieldValues 
	 *   Get field values array
	 * @access public
	 * @return array
	 */
	public function getFieldValues($container)
	{
		$values = array();

		foreach($this->fields as $field => $accessor) {
			if($accessor instanceof IgnoreFieldAccessor)
				continue;
			$values[$field] = $accessor->get($container);
		}

		return $values;
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($container = null)
	{
		return array_keys($this->fields);
		//return array_keys(array_filter($this->fields, function($accessor){
		//	if($accessor instanceof IgnoreFieldAccessor) {
		//		return false;
		//	}
		//	return true;
		//}));
	}
}
