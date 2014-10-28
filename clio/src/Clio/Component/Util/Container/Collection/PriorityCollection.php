<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Collection as CollectionInterface;

/**
 * PriorityCollection
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class PriorityCollection extends Collection 
{
	private $priorities = array();

	public function clear()
	{
		$this->priorities = array();
		parent::clear();
	}

	public function set($key, $value, $priority = 0)
	{
		parent::set($key, $value);

		$this->priorities[$key] = $priority;
		return $this;
	}

	public function add($value, $priority = 0)
	{
		parent::add($value);

		$this->priorities[$this->find($value)] = $priority;

		return $this;
	}

	public function removeByKey($key)
	{
		unset($this->priorities[$key]);
		return parent::removeByKey($key);
	}

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize(array($this->values, $this->priorities));
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
		list(
			$this->values,
			$this->priorities
		) = unserialize($serialized);
	}

	public function getValuesOrdered()
	{
		$values = $this->toArray();
		rsort($this->priorities);

		foreach($this->priorities as $key => $pri) {
			$sorted[$key] = $values[$key];
		}
		return $sorted;
	}

	public function getValuesReversed()
	{
		$values = $this->toArray();
		sort($this->priorities);

		foreach($this->priorities as $key => $pri) {
			$sorted[$key] = $values[$key];
		}
		return $sorted;
	}

	public function filter(\Closure $closure)
	{
		parent::filter($closure);

		$this->priorities = array_intersect_key($this->priorities, $this->toArray());
	}

	public function map(\Closure $closure) 
	{
		parent::map($closure);

		$this->priorities = array_intersect_key($this->priorities, $this->toArray());
	}
}

