<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\SchemaAccessor;
/**
 * FieldAccessorCollection 
 * 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorCollection implements SchemaAccessor
{
	/**
	 * accessors 
	 * 
	 * @var array
	 * @access private
	 */
	private $accessors = array();

	/**
	 * __construct 
	 * 
	 * @param array $accessors 
	 * @access public
	 * @return void
	 */
	public function __construct(array $accessors = array())
	{
		foreach($accessors as $field => $accessor) {
			$this->addFieldAccessor($accessor);
		}
	}

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($container, $field)
	{
		return $this->getFieldAccessor($field)->get($container);
	}
	
	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($container, $field, $value)
	{
		$this->getFieldAccessor($field)->set($container, $value);
		return $this;
	}

	/**
	 * isEmpty 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isEmpty($container, $field)
	{
		return $this->getFieldAccessor($field)->isEmpty($container);
	}

	/**
	 * clear 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($container, $field)
	{
		$container->getFieldAccessor($field)->clear($container);
		return $this;
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

		foreach($this->accessors as $field => $accessor) {
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
		return array_keys($this->accessors);
		//return array_keys(array_filter($this->accessors, function($accessor){
		//	if($accessor instanceof IgnoreFieldAccessor) {
		//		return false;
		//	}
		//	return true;
		//}));
	}


	/**
	 * addFieldAccessor 
	 * 
	 * @param PropertyFieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function addFieldAccessor(FieldAccessor $accessor)
	{
		$this->accessors[$accessor->getFieldName()] = $accessor;

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
		return isset($this->accessors[$field]);
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
		if(!isset($this->accessors[$field])) {
			throw new \RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->accessors[$field];
	}
}
