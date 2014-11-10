<?php
namespace Clio\Component\Util\Container\Set;

use Clio\Component\Util\Container\Set;
use Clio\Component\Util\Container\AbstractContainer;
use Clio\Component\Util\Container\Storage;
use Clio\Component\Util\Container\Storage\ValidatableStorage;
use Clio\Component\Util\Validator\Validator,
	Clio\Component\Util\Validator\ClassValidator
;

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

	private $valueValidator;

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

		if(!$this->storage instanceof Storage\ValidatableStorage) {
			$this->storage = new ValidatableStorage($this->storage);
			$this->storage->setValueValidator(new ClassValidator('Clio\Component\Util\Container\Storage'));
		}

		// Insert with default priority
		foreach($values as $value) {
			$this->add($value);
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
	public function add($value, $priority = null)
	{
		if(null === $priority) {
			$priority = self::DEFAULT_PRIORITY;
		}
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
		$storage = new ValidatableStorage(new Storage\ArrayStorage());
		
		if($this->valueValidator) {
			$storage->setValueValidator($this->valueValidator);
		}

		return $storage;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function count()
	{
		return count($this->toArray());
	}
    
    /**
     * setValueValidator 
     * 
     * @param Validator $valueValidator 
     * @access public
     * @return void
     */
    public function setValueValidator(Validator $valueValidator)
    {
		$this->valueValidator = $valueValidator;

		foreach($this->getStorage() as $set) {
			$set->setValueValidator($this->valueValidator);
		}
    }
}

