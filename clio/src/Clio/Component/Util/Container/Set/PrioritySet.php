<?php
namespace Clio\Component\Util\Container\Set;

use Clio\Component\Util\Container\Set;
use Clio\Component\Util\Container\AbstractContainer;
use Clio\Component\Util\Container\Storage;

/**
 * PrioritySet 
 * 
 * @uses AbstractContainer
 * @uses Set
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PrioritySet extends AbstractContainer implements Set 
{
	const DEFAULT_PRIORITY = 0;

	private $sorted;

	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		if(!$this->storage) {
			$this->storage = new Storage\ArrayStorage();
		}

		if(!$this->storage instanceof Storage\RandomAccessable) {
			throw new \InvalidArgumentException('RandomAccessable is required.'); 
		}

		foreach($values as $priority => $pvs) {
			foreach($pvs as $v) {
				$this->storage->add($v, $priority);
			}
		}
	}

	public function toArray()
	{
		if(!$this->sorted) {
			$prioritySets = $this->storage->toArray();

			krsort($prioritySets);

			$sorted = array();
			foreach($prioritySets as $set) {
				$sorted = array_merge($sorted, $set->toArray());
			}

			$this->sorted = $sorted;
		}
		
		return $this->sorted;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getValues()
	{
		return $this->toArray();
	}

	/**
	 * add 
	 * 
	 * @param mixed $value 
	 * @param mixed $priority 
	 * @access public
	 * @return void
	 */
	public function add($value, $priority = self::DEFAULT_PRIORITY)
	{
		if(!$this->getStorage()->existsAt($priority)) {
			$this->storage->insertAt($priority, $this->createSetAccessable());
		}

		$this->storage->getAt($priority)->insert($value);

		$this->sorted = null; 
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function contains($value)
	{
		foreach($this->getStorage() as $set) {
			if($set->exists($value)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		foreach($this->getStorage() as $set) {
			if($set->exists($value)) {
				$set->remove($value);
				break;
			}
		}

		$this->sorted = null;
	}

	protected function createSetAccessable()
	{
		return new Storage\ArrayStorage();
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->toArray());
	}

	public function count()
	{
		return count($this->toArray());
	}
}

