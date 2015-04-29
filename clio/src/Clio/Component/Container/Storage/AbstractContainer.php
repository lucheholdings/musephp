<?php
namespace Clio\Component\Container\Storage;

use Clio\Component\Container\Container;

abstract class AbstractContainer implements Container 
{
    /**
     * storage 
     * 
     * @var Storage 
     * @access protected
     */
	protected $storage;

	public function __construct($values = null)
	{
        if($values instanceof Storage) {
            $this->storage = $values;
        } else {
            $this->initStorage($values ? : array());
        }
	}

	protected function initStorage(array $defaults = array())
	{
		$this->storage = new ArrayStorage\Storage($defaults);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
	{
		$this->storage->removeAll();
	}

	/**
	 * {@inheritdoc}
	 */
	public function toArray()
	{
		return $this->storage->toArray();
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStorage()
	{
		return $this->storage;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setStorage(Storage $storage)
	{
		$this->storage = $storage;
		return $this;
	}

	public function getIterator()
	{
		return $this->getStorage()->getIterator();
	}

	public function count()
	{
		if(!$this->storage instanceof \Countable) {
			throw new \RuntimeException('Storage is not countable.');
		}
		return $this->storage->count();
	}

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		if(!$this->storage instanceof \Serializable) {
			throw new \RuntimeException('Storage is not serializable.');
		}

		return serialize($this->storage);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$this->storage = unserialize($serialized);
	}

	public function filter(\Closure $callable)
	{
		$container = clone $this;
		$container->setStorage($this->getStorage()->filter($callable));

		return $container;
	}

	public function map(\Closure $callback)
	{
		$container = clone $this;
		$container->setStorage($this->getStorage()->map($callback));

		return $container;
	}
}

