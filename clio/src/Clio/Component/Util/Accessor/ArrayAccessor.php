<?php
namespace Clio\Component\Util\Accessor;

/**
 * ArrayAccessor 
 * 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayAccessor implements Accessor 
{
	/**
	 * data 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $data;

	/**
	 * __construct 
	 * 
	 * @param array $object 
	 * @access public
	 * @return void
	 */
	public function __construct(array $data)
	{
		$this->data = array();
		foreach($data as $key => $value) {
			$this->set($key, $value);
		}
	}

	/**
	 * get 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($field)
	{
		return $this->data[$field];
	}

	/**
	 * set 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($field, $value)
	{
		if(null === $value) {
			if(isset($this->data[$field])) {
				unset($this->data[$field]);
			}
		} else { 
			$this->data[$field] = $value;
		}
		return $this;
	}

	/**
	 * isEmpty 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isEmpty($field)
	{
		return !isset($this->data[$field]) || (null === $this->data[$field]);
	}

	/**
	 * clear 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($field)
	{
		unset($this->data[$field]);
	}

	/**
	 * getData 
	 * 
	 * @access public
	 * @return void
	 */
	public function getData()
	{
		return $this->data;
	}

	public function getFieldValues()
	{
		return $this->data;
	}

	public function getFieldNames()
	{
		return array_keys($this->data);
	}

	public function isSupportMethod($field, $methodType)
	{
		return true;
	}
}

