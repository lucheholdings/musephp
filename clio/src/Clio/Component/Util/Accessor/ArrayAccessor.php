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
		$this->data[$field] = $value;
	
		return $this;
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($field)
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
		$this->set($field, null);
	}

	/**
	 * existsField 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function existsField($field)
	{
		return array_key_exists($field, $this->data);
	}

	/**
	 * getData 
	 * 
	 * @access public
	 * @return void
	 */
	public function getData()
	{
		return array_filter($this->data, function($v) {
			return null !== $v;		
		});
	}

	public function getRaw()
	{
		return $this->data;
	}

	/**
	 * getFieldValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldValues()
	{
		return $this->data;
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames()
	{
		return array_keys($this->data);
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($field, $methodType)
	{
		return true;
	}
}

