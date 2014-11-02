<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface;
use Clio\Component\Util\Container\AbstractContainer;

/**
 * Collection 
 * 
 * @uses AbstractContainer
 * @uses CollectionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends AbstractContainer implements CollectionInterface
{
	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		foreach($values as $key => $value) {
			$this->storage->insertAt($key, $value);
		}
	}

	/**
	 * getKeys 
	 *   Get all aliases or numeric index of the elements
	 * @access public
	 * @return void
	 */
	public function getKeys()
	{
		return array_keys($this->toArray());
	}

	/**
	 * getKeyValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeyValues()
	{
		return $this->toArray();
	}

	/**
	 * add 
	 *   Add value into collection pool.
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function add($value)
	{
		$this->getStorage()->insert($value);
		return $this;
	}

	/**
	 * set 
	 *   Add aliased value into collection pool. 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->getStorage()->insertAt($key, $value);
		return $this;
	}

	/**
	 * get 
	 *   Get aliased value from collection pool. 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		return $this->getStorage()->getAt($key);
	}

	/**
	 * has 
	 *   Check value is existed in collection pool. 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function has($value)
	{
		return $this->getStorage()->exists($key);
	}

	/**
	 * hasKey 
	 *   Check aliased value is existed in collection pool. 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasKey($key)
	{
		return $this->getStorage()->existsAt($key);
	}

	/**
	 * remove 
	 *   Remove value from collection pool 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function remove($value)
	{
		$this->getStorage()->remove($key);
	}

	/**
	 * removeByKey 
	 *   Remove aliased value from collection pool.
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeByKey($key)
	{
		$this->getStorage()->removeAt($key);
	}

	/**
	 * offsetExists 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

	/**
	 * offsetGet 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	/**
	 * offsetUnset 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($key)
	{
		$this->removeByKey($key);
	}
}

