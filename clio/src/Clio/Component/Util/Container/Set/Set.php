<?php
namespace Clio\Component\Util\Container\Set;

use Clio\Component\Util\Container\Set as SetInterface;
use Clio\Component\Util\Container\AbstractContainer;

/**
 * Set 
 * 
 * @uses Set
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Set extends AbstractContainer implements SetInterface, \Serializable
{
	/**
	 * values
	 * 
	 * @var mixed
	 * @access protected
	 */
	private $values = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(array $values = array())
	{
		$this->values = $values;

		$this->initContainer();
	}

	/**
	 * initContainer 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
		/* Initialize class definition and more */
	}

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRaw()
	{
		return $this->values;
	}

	/**
	 * toArray
	 *   Get collection pool
	 * @access public
	 * @return void
	 */
	public function toArray()
	{
		return array_values($this->values);
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->values);
	}


	/**
	 * clear
	 *   Remove all values in collection pool 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		$this->values = array();
	}

	/**
	 * add
	 *   Add into collection pool. 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function add($value)
	{
		if($this->hasValueValidator()) {
			$value = $this->getValueValidator()->validate($value);
		}
		$this->values[] = $value;

		return $this;
	}

	/**
	 * has
	 *   Check value is existed in collection pool. 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($value)
	{
		return in_array($value, $this->values);
	}

	/**
	 * contains 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function contains($value)
	{
		return $this->has($value);
	}

	/**
	 * removeByKey 
	 *   Remove aliased value from collection pool.
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove($value)
	{
		if(false === ($key = array_search($value, $this->values))) {
			throw new \Clio\Component\Exception\InvalidArgumentException('value is not exists');
		}
		$removed = $this->values[$key];
		unset($this->values[$key]);

		return $removed;
	}

	/**
	 * merge 
	 * 
	 * @param MapInterface $map 
	 * @access public
	 * @return void
	 */
	public function merge(SetInterface $map)
	{
		foreach($map as $value) {
			$this->add($value);
		}
	}

	/**
	 * getIterator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->values);
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->values);
	}

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize($this->values);
	}

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		$this->values = unserialize($serialized);
	}

	/**
	 * searchBy 
	 * 
	 * @param \Closure $closure 
	 * @access public
	 * @return void
	 */
	public function searchBy(\Closure $closure)
	{
		foreach($this->values as $data) {
			if($closure($data)) {
				return $data;
			}
		}
		return null;
	}
}

